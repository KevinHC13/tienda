<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sales_id',
        'code'
    ];

    public function detalles()
    {
        return $this->hasMany(ReturnsDetails::class, 'returns_id', 'id');
    }

    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sales_id', 'id');
    }

    public function productos()
    {
        return $this->belongsToMany(Product::class, 'returns_details', 'returns_id', 'product_id')
                    ->withPivot('quantity');
    }
}
