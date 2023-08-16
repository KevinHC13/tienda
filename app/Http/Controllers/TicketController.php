<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class TicketController extends Controller
{
    public function create_pdf(Sales $sale)
    {

        $html = view('ticket.index',[
            'sale' => $sale
        ]);

        $pdf = PDF::loadHTML($html);

        return $pdf->download($sale->code . '.pdf');
    }

    public function create_xml(Sales $sale)
    {
        $xml = new \SimpleXMLElement('<root/>');
        $xml->addChild('client');
        $xml->client->addChild('name', $sale->client->name);
        $xml->client->addChild('address', $sale->client->direccion);
        $xml->client->addChild('email', $sale->client->email);

        $xml->addChild('factura');
        $xml->factura->addChild('reference', $sale->code);
        $xml->factura->addChild('seller', $sale->user->username);
        $xml->factura->addChild('date', $sale->created_at);
        $xml->factura->addChild('subtotal', $sale->total * 0.84);
        $xml->factura->addChild('iva', $sale->total * 0.16);
        $xml->factura->addChild('total', $sale->total);


        $xml->addChild('products');
        foreach($sale->detalles as $detail){
            $productXml = $xml->products->addChild('product');
            $productXml->addChild('name', $detail->producto->name);
            $productXml->addChild('quantity', $detail->quantity);
            $productXml->addChild('sale_price', $detail->producto->sale_price);
            $productXml->addChild('total', $detail->producto->sale_price * $detail->quantity );

        }
        
        $xmlContent = $xml->asXML();

        $headers = [
            'Content-Disposition' => 'attachment; filename=cliente.xml',
            'Content-Type' => 'text/xml',
        ];
    
        return response()->streamDownload(function () use ($xmlContent) {
            echo $xmlContent;
        }, $sale->code.'.xml', $headers);
    }

    public function exportXlsx(Sales $sale)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Informacion del cliente
        $sheet->setCellValue('A1', 'Información del Cliente:');
        $sheet->setCellValue('A2', 'Nombre');
        $sheet->setCellValue('B2', $sale->client->name);
        $sheet->setCellValue('A3', 'Dirección');
        $sheet->setCellValue('B3', $sale->client->direccion);
        $sheet->setCellValue('A4', 'Correo');
        $sheet->setCellValue('B4', $sale->client->email);

        // Infromacion de la cotizacon
        $sheet->setCellValue('A5', 'Información de la Cotizacion:');
        $sheet->setCellValue('A6', 'Referencia');
        $sheet->setCellValue('B6', $sale->code);
        $sheet->setCellValue('A7', 'Vendedor');
        $sheet->setCellValue('B7', $sale->user->username);
        $sheet->setCellValue('A8', 'Fecha');
        $sheet->setCellValue('B8', $sale->created_at);
        $sheet->setCellValue('A9', 'Subtotal');
        $sheet->setCellValue('B9', $sale->total * 0.84);
        $sheet->setCellValue('A10', 'IVA');
        $sheet->setCellValue('B10', $sale->total * 0.16);
        $sheet->setCellValue('A11', 'Total');
        $sheet->setCellValue('B11', $sale->total);

        // Productos
        $sheet->setCellValue('A12','Producto');
        $sheet->setCellValue('B12','Cantidad');
        $sheet->setCellValue('C12','Precio Unitario');
        $sheet->setCellValue('D12','Total');

        $row = 13;
        foreach ($sale->detalles as $detail) {
            $sheet->setCellValue('A' . $row, $detail->producto->name);
            $sheet->setCellValue('B' . $row, $detail->quantity);
            $sheet->setCellValue('C' . $row, $detail->producto->sale_price);
            $sheet->setCellValue('D' . $row, $detail->quantity * $detail->producto->sale_price);
            $row++;
        }

        // Crear el archivo y descargarlo
         $writer = new Xlsx($spreadsheet);
         $filename = $sale->code . '.xlsx';
        
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="' . $filename . '"');
         header('Cache-Control: max-age=0');
     
         $writer->save('php://output');
     

    }
}
