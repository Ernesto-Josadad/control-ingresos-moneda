<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupos extends Model
{
    use HasFactory;

    protected $table = 'clave_subgrupos';
    public $primaryKey = "id"; 
    protected $fillable = [
        'clave_grupo_id',
        'codigo',
        'descripcion',
        'costo'
    ];

}