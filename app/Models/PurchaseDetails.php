<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchases_id',
        'product_id',
        'add_stock',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchases_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}
