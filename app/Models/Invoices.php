<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'payment_status',
        'status'
    ];

    public function sale()
    {
        $this->belongsTo(Sales::class);
    }
}
