<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'codigo',
      'telefono',
      'email',
      'picture',
      'ciudad',
      'direccion',
      'pais'

    ];

    public function purchas()
    {
      return $this->hasMany(Provedor::class);
    }
}
