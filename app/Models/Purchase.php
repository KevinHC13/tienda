<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'provedor_id',
        'code',
        'date',
        'tota',
        ];

    public function provedor()
    {
        return    $this->belongsTo(Provedor::class);
    }

    public function detalles()
    {
        return $this->hasMany(PurchaseDetails::class, 'purchases_id', 'id');
    }
    public function productos()
    {
        return $this->belongsToMany(Product::class, 'purchase_details', 'purchases_id', 'product_id')
                    ->withPivot('add_stock');
    }
}
