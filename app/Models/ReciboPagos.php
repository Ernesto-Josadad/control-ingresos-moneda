<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboPagos extends Model
{
    use HasFactory;
    protected $table = 'recibo_pagos'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'folio',
        'cantidad',
        'total',
        'fecha'
    ];
    
}
