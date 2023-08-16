<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Returns;
use App\Models\ReturnsDetails;
use App\Models\Sales;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReturnsController extends Controller
{

    public function index()
    {
        $returns = Returns::all();
        $sales = Sales::all();

        return view('returns.index',[
            'returns' => $returns,
            'sales' => $sales,
        ]);
    }
    public function create(Sales $sale)
    {
        return view('returns.create',[
            'sale' => $sale
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'products' => 'required|array',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Debe seleccionar al menos un producto', 'errors' => $e->errors()], 422);
        }

        $products = $request->input('products');


        $uuid = (string) Str::uuid();

        $return = Returns::create([
            'code' => $uuid,
            'sales_id' => $request->input('sale_id'),
        ]);

        foreach ($products as $product_id => $product) {
            ReturnsDetails::create([
                'returns_id' => $return->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);

            $product_register = Product::find($product['product_id']);

            if ($product_register) {
                $product_register->stock = $product_register->stock + $product['quantity'];
                $product_register->save();
            }
        }

        return response()->json(['message' => 'Devolución creada con éxito']);
    }

    public function show(Returns $return)
    {
        return view('returns.show',[
            'return' => $return,
        ]);
    }

    public function create_pdf()
    {
        $returns = Returns::all();

        $html = view('returns.report',[
            'returns' => $returns
        ]);
         
        $pdf = PDF::loadHTML($html);

        return $pdf->download('reporte_devoluciones.pdf');
    }

    public function create_xlsx()
    {
        $returns = Returns::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Titulos
        $sheet->setCellValue('A1','Vendedor');
        $sheet->setCellValue('B1','Fecha');
        $sheet->setCellValue('C1','Referencia');
        $sheet->setCellValue('D1','Productos');
        $sheet->setCellValue('E1','Cliente');
        
        $row = 2;
        
        foreach($returns as $return){
            $sheet->setCellValue('A' . $row, $return->sale->user->username);
            $sheet->setCellValue('B' . $row, $return->created_at);
            $sheet->setCellValue('C' . $row, $return->code);
            $sheet->setCellValue('D' . $row, $return->detalles->count());
            $sheet->setCellValue('E' . $row, $return->sale->client->name);
            $row++;
        }


        // Crear el archivo y descargarlo
         $writer = new Xlsx($spreadsheet);
         $filename = 'reporte_devoluciones.xlsx';
        
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="' . $filename . '"');
         header('Cache-Control: max-age=0');
     
         $writer->save('php://output');
     

    }
}


