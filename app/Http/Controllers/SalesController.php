<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleDetails;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Muestra la lista de ventas paginada.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sales = Sales::paginate(10);

        return view('sale.index', [
            'sales' => $sales
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva venta.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $clients = Client::all();

        return view('sale.create', [
            'categories' => $categories,
            'clients' => $clients,
        ]);
    }

    /**
     * Almacena una nueva venta en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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
        $uuid = Str::uuid();
        $id = $uuid->toString();

        $sale = Sales::create([
            'client_id' => $request->client_id,
            'code' => $id,
            'total' => $request->total,
            'user_id' => auth()->user()->id,
        ]);

        foreach ($products as $product_id => $product) {
            SaleDetails::create([
                'sales_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['added'],
            ]);

            $product_register = Product::find($product['id']);

            if ($product_register) {
                $product_register->stock = $product_register->stock - $product['added'];
                $product_register->save();
            }
        }

        return response()->json($request);
    }

    /**
     * Obtiene la lista de productos según la categoría seleccionada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts(Request $request)
    {
        if ($request->category_id == 0) {
            $products = Product::all();
        } else {
            $products = Product::where('category_id', $request->category_id)->get();
        }

        $products = $products->toJson();
        return response()->json($products);
    }

    /**
     * Muestra los detalles de una venta específica.
     *
     * @param  \App\Models\Sales  $sale
     * @return \Illuminate\View\View
     */
    public function show(Sales $sale)
    {
        return view('sale.show', [
            'sale' => $sale
        ]);
    }

    /**
     * Crea y descarga un archivo PDF con el reporte de ventas.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function create_pdf()
    {
        $sales = Sales::all();

        $html = view('sale.report', [
            'sales' => $sales
        ]);

        $pdf = PDF::loadHTML($html);

        return $pdf->download('reporte_ventas.pdf');
    }

    /**
     * Crea y descarga un archivo XLSX con el reporte de ventas.
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function create_xlsx()
    {
        $sales = Sales::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Titulos
        $sheet->setCellValue('A1', 'Vendedor');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Referencia');
        $sheet->setCellValue('D1', 'Productos');
        $sheet->setCellValue('E1', 'Cliente');
        $sheet->setCellValue('F1', 'Total');
        $sheet->setCellValue('G1', 'Facturador');

        $row = 2;

        foreach ($sales as $sale) {
            $sheet->setCellValue('A' . $row, $sale->user->username);
            $sheet->setCellValue('B' . $row, $sale->created_at);
            $sheet->setCellValue('C' . $row, $sale->code);
            $sheet->setCellValue('D' . $row, $sale->detalles->count());
            $sheet->setCellValue('E' . $row, $sale->client->name);
            $sheet->setCellValue('F' . $row, $sale->total);
            $sheet->setCellValue('G' . $row, $sale->user->username);
            $row++;
        }

        // Crear el archivo y descargarlo
        $writer = new Xlsx($spreadsheet);
        $filename = 'reporte_ventas.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }
}
