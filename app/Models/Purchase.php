<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'provedor_id',
        'estatus',
        'code',
        'tota',
        'pagado',
        'pendiente',
        'estatus_pago',
        ];

    public function provedor()
    {
        return    $this->belongsTo(Provedor::class);
    }
    public function product()
    {
        return    $this->belongsTo(Product::class);
    }

    public function create_pdf()
    {
        $purchases = Purchase::all();

        $html = view('purchase.report',[
            'purchases' => $purchases
        ]);

        $pdf = PDF::loadHTML($html);

        return $pdf->download('reporte_ventas.pdf');
    }
}
