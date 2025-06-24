<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conocimiento extends Model // modelo el cual va acceder a ciertos atributos de la base de datos
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
