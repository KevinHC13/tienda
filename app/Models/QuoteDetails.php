<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteDetails extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'quotes_id',
        'product_id',
        'quantity',
    ];

    public function quote()
    {
        return $this->belongsTo(Quotes::class, 'quotes_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
