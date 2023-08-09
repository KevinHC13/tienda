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
}