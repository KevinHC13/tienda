<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'sales_id',
        'product_id',
        'quantity',
    ];
    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sales_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

 
}
