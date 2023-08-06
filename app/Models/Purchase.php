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
        'estatus',
        'tota',
        'pagado',
        'pendiente',
        'estatus_pago',
        ];

    public function provedor()
    {
        return    $this->belongsTo(Provedor::class);
    }
}
