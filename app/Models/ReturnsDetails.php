<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnsDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'returns_id',
        'product_id',
        'quantity',
    ];

    public function return()
    {
        return $this->belongsTo(Returns::class, 'returns_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
   

}
