<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cotizacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'product_id',
        'cantidad',
        'iva',
        'subtotal',
        'total',
        'referencia',
        'descripcion',
        'price',
        'picture',
        'estado',
        
        


    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function product()
    {
        return    $this->belongsTo(Product::class);
    }

}
