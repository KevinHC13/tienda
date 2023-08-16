<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\QuoteDetails;
use App\Models\Quotes;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class QuotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $quotes = Quotes::paginate(10);
    
        return view('quotes.index', [
            'quotes' => $quotes
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $clients = Client::all();

        return view('quotes.create', [
            'categories' => $categories,
            'clients' => $clients,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'client_id' => 'required',     
                'products' => 'required', 
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Debe seleccionar al menos un producto y un cliente', 'errors' => $e->errors()], 422);
        }
        
        $products = $request->json('products');
        $uuid = Str::uuid(); // Genera un UUID único
        $id = $uuid->toString(); // Convierte el UUID en una cadena para usarlo como ID

        $quote = Quotes::create([
            'client_id' => $request->client_id,
            'code' => $id,
            'total' => $request->total,
            'user_id' => auth()->user()->id,
        ]);

        foreach ($products as $product_id => $product) {
            QuoteDetails::create([
                'quotes_id' => $quote->id,
                'product_id' => $product['id'],
                'quantity' => $product['added'],
            ]);
        }

        return response()->json($request);
    }

    public function show(Quotes $quote)
    {
        return view('quotes.show', [
            'quote' => $quote
        ]);
    }

    public function exportXlsx(Quotes $quote)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Informacion del cliente
        $sheet->setCellValue('A1', 'Información del Cliente:');
        $sheet->setCellValue('A2', 'Nombre');
        $sheet->setCellValue('B2', $quote->client->name);
        $sheet->setCellValue('A3', 'Dirección');
        $sheet->setCellValue('B3', $quote->client->direccion);
        $sheet->setCellValue('A4', 'Correo');
        $sheet->setCellValue('B4', $quote->client->email);

        // Infromacion de la cotizacon
        $sheet->setCellValue('A5', 'Información de la Cotizacion:');
        $sheet->setCellValue('A6', 'Referencia');
        $sheet->setCellValue('B6', $quote->code);
        $sheet->setCellValue('A7', 'Vendedor');
        $sheet->setCellValue('B7', $quote->user->username);
        $sheet->setCellValue('A8', 'Fecha');
        $sheet->setCellValue('B8', $quote->created_at);
        $sheet->setCellValue('A9', 'Subtotal');
        $sheet->setCellValue('B9', $quote->total * 0.84);
        $sheet->setCellValue('A10', 'IVA');
        $sheet->setCellValue('B10', $quote->total * 0.16);
        $sheet->setCellValue('A11', 'Total');
        $sheet->setCellValue('B11', $quote->total);

        // Productos
        $sheet->setCellValue('A12', 'Producto');
        $sheet->setCellValue('B12', 'Cantidad');
        $sheet->setCellValue('C12', 'Precio Unitario');
        $sheet->setCellValue('D12', 'Total');

        $row = 13;
        foreach ($quote->detalles as $detail) {
            $sheet->setCellValue('A' . $row, $detail->producto->name);
            $sheet->setCellValue('B' . $row, $detail->quantity);
            $sheet->setCellValue('C' . $row, $detail->producto->sale_price);
            $sheet->setCellValue('D' . $row, $detail->quantity * $detail->producto->sale_price);
            $row++;
        }

        // Crear el archivo y descargarlo
         $writer = new Xlsx($spreadsheet);
         $filename = $quote->code . '.xlsx';
        
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="' . $filename . '"');
         header('Cache-Control: max-age=0');
     
         $writer->save('php://output');
    }
}
