<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
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
        return $this->hasMany(QuoteDetails::class, 'quotes_id', 'id');
    }
    public function productos()
    {
        return $this->belongsToMany(Product::class, 'quote_details', 'quotes_id', 'product_id')
                    ->withPivot('quantity');
    }

}
