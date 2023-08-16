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
}
