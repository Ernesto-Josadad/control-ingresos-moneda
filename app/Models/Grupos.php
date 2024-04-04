<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;

    protected $table = 'clave_grupos'; // Nombre de la tabla en la base de datos

    public $primaryKey = 'id'; // Clave primaria de la tabla

    protected $fillable = [ // Atributos asignables en masa
        'clave', // Clave del grupo
        'concepto' // Concepto del grupo
    ];
}

