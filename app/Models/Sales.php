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
        'pay',
        'status',
        'total',
        'partial_payment',
        'pending_payment',
        'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function invoice()
    {
        $this->belongsTo(Invoices::class);
    }
<<<<<<< HEAD
    public function productos()
    {
        return $this->belongsToMany(Product::class, 'sale_details', 'sales_id', 'product_id')
                    ->withPivot('quantity');
    }

    public function return()
    {
        return $this->hasMany(Returns::class, 'sales_id', 'id');
    }


=======
>>>>>>> 13c7648caf3a7acca2b96373cc3b65bcf46af53f
}
