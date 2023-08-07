<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usario extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'password',
        'telefono',
        'email',
        'picture',
        'rol',
    ];


}
