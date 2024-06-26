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
        'recibo_pago_id',
        'clave_subgrupo_id',
        'importe',
        'cantidad_subgrupo'
    ];

    public function recibo()
    {
        return $this->belongsTo(Recibo::class, 'recibo_pago_id');
    }
    // public function recibo()
    // {
    //     return $this->belongsTo(Recibo::class);
    // }

    public function subgrupos()
    {
        return $this->belongsTo(Subgrupos::class, 'clave_subgrupo_id');
    }
     
}



