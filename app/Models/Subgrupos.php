<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupos extends Model
{
    use HasFactory;

    protected $table = 'clave_subgrupos'; // Nombre de la tabla en la base de datos

    public $primaryKey = 'id'; // Clave primaria de la tabla

    protected $fillable = [ // Atributos asignables en masa
        'clave_grupo_id', // Clave foránea que referencia al grupo al que pertenece el subgrupo
        'codigo', // Código del subgrupo
        'descripcion', // Descripción del subgrupo
        'costo' // Costo del subgrupo
    ];
}

