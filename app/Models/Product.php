<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'purchase_price',
        'sale_price',
        'stock',
        'user_id',
        'category_id',
        'subcategory_id',
        'brand_id',
        'picture'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'purchase_details', 'product_id', 'purchases_id')
                    ->withPivot('add_stock');
    }

    public function sale_detalles()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function ventas()
    {
        return $this->belongsToMany(Sales::class, 'sale_details', 'product_id', 'sales_id')
                    ->withPivot('quantity');
    }
}



