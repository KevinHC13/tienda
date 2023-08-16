<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provedor;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //obtiene todos las compras de la base de datos 
        $purchases = Purchase::paginate(10);

        return view('purchase.index',[
            'purchases' => $purchases
        ]);
    }

    // Muestra la vista para crear una nueva venta
    public function create()
    {
        // Selecciona todos los proveedores para elegir uno en la visa
        $provedores = Provedor::all();
        $products = Product::all();
        //devuelve la vista purchase.create
        return view('purchase.create',[
            'provedores' => $provedores,
            'products' => $products,
        ]);
  
    }

    // Crea un nuevo registro de la compra
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'provedor_id' => 'required',
                'code' => 'required|integer|unique:purchases',        
                'date' => 'required', 
            ]);
        }catch(ValidationException $e){
            return response()->json(['message' => 'Error en los campos', 'errors' => $e->errors()], 422);
        }

        $products = $request->json('products');

        if($products)
        {
        try
        {
            $purchase = Purchase::create([
                'provedor_id' => $request->provedor_id,
                'code' => $request->code,
                'date' => $request->date,
                'tota' => $request->total,
            ]);
        }catch(ValidationException $e){
            return response()->json(['message' => 'Error al crear la compra', 'errors' => $e->errors()], 422);
        }

            foreach ($products as $productId => $quantity) {
                try
                {
                    PurchaseDetails::create([
                        'purchases_id' => $purchase->id,
                        'product_id' => $productId,
                        'add_stock' => $quantity,
                    ]);
                }catch(ValidationException $e){
                    return response()->json(['message' => 'Error al crear los productos', 'errors' => $e->errors()], 422);
                }
        
               try
               {
                $product_register = Product::find($productId);

                if ($product_register) {
                    $product_register->stock = $product_register->stock + $quantity;
                    $product_register->save();
                } 
               }catch(ValidationException $e){
                return response()->json(['message' => 'Error al sumar el stock', 'errors' => $e->errors()], 422);
            }
                
            }
        }
        

        
        return response()->json($request);
    }

    // Elimina la compra pasada como parametro
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchase.index');
    }

    // Muestra la vista para editar una compra
    public function edit(Purchase $purchase)
    {
        $provedores = Provedor::all();
        return view('purchase.edit',[
            'purchase' => $purchase,
            'provedores' => $provedores,
        ]);
    }

    // Actualiza a los datos enviados
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'provedor_id' => 'required',       
            'tota' => 'required', 
            'pagado' => 'required',
        ]);

        // Valida que no se quiera pagar mas del total
        if($request->pagado > $request->tota)
        {
           // Redireccionar de vuelta a la página anterior con un mensaje de error
            return back()->with('mensaje', 'No puede pagar mas que el total');
        }

        $purchase->provedor_id = $request->provedor_id;
        $purchase->estatus = ($request->tota == $request->pagado) ? "Pagado" : "Pendiente" ;
        $purchase->tota = $request->tota;
        $purchase->pagado = $request->pagado;
        $purchase->pendiente = $request->tota - $request->pagado;
        $purchase->estatus_pago = ($request->tota == $request->pagado) ? "Pagado" : "Pendiente" ;
        $purchase->save();

        return redirect()->route('purchase.index');
    }

    // Muestra la informacion general de la compra
    public function show(Purchase $purchase)
    {
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $purchase->date)->format('d/m/Y');
        
        return view('purchase.show',[
            'purchase' => $purchase,
            'fecha' => $fecha
        ]);
    }

    public function addProduct(Request $request)
    {
        $stock_product = $request->stock_product;
        $purchase_price = $request->purchase_price;
        $product = Product::findOrFail($request->product_id);

        $respuesta = [
            'product' => $product,
            'stock' => $stock_product,
            'purchase_price' => $purchase_price
        ];

        return response()->json($respuesta);
    }

    public function create_pdf()
    {
        $purchases = Purchase::all();

        $html = view('purchase.report',[
            'purchases' => $purchases
        ]);

        $pdf = PDF::loadHTML($html);

        return $pdf->download('reporte_compras.pdf');
    }

    public function create_xlsx()
    {
        $purchases = Purchase::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Titulos
        $sheet->setCellValue('A1','Codigo');
        $sheet->setCellValue('B1','Proveedor');
        $sheet->setCellValue('C1','Productos');
        $sheet->setCellValue('D1','Subtotal');
        $sheet->setCellValue('E1','IVA');
        $sheet->setCellValue('F1','Total');
        $sheet->setCellValue('G1','Fecha');
        
        $row = 2;
        
        foreach($purchases as $purchase){
            $sheet->setCellValue('A' . $row, $purchase->code);
            $sheet->setCellValue('B' . $row, $purchase->provedor->name);
            $sheet->setCellValue('C' . $row, $purchase->detalles->count());
            $sheet->setCellValue('D' . $row, $purchase->tota * 0.84);
            $sheet->setCellValue('E' . $row, $purchase->tota * 0.16);
            $sheet->setCellValue('F' . $row, $purchase->tota);
            $sheet->setCellValue('G' . $row, $purchase->created_at);
            $row++;
        }


        // Crear el archivo y descargarlo
         $writer = new Xlsx($spreadsheet);
         $filename = 'reporte_compras.xlsx';
        
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="' . $filename . '"');
         header('Cache-Control: max-age=0');
     
         $writer->save('php://output');
     

    }
}
