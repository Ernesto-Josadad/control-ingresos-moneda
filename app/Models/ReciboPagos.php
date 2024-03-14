<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboPagos extends Model
{
    use HasFactory;
    protected $table = 'detalle_pagos'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'pago_recibo_id',
        'clave_subgrupo_id',
        'importe',
        'cantidad_subgrupo'
    ];
    
}
