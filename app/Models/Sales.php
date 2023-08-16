<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'invoice_id',
        'code',
        'total',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    public function detalles()
    {
        return $this->hasMany(SaleDetails::class, 'sales_id', 'id');
    }
    public function productos()
    {
        return $this->belongsToMany(Product::class, 'sale_details', 'sales_id', 'product_id')
                    ->withPivot('quantity');
    }

    public function return()
    {
        return $this->hasMany(Returns::class, 'sales_id', 'id');
    }


}
