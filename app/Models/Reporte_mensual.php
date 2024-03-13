<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte_mensual extends Model
{
    use HasFactory;
    protected $table = 'ingresos';
    protected $fillable = [
        'recibo_pago_id',
        'ejercicio_fiscal',
        'fecha_elaboracion',
        'saldo_mes',
        'folio_inicial',
        'folio_final',
        'cantidad_folios_utilizados',
        'ingresos_subgrupo',
        'fecha_inicio_periodo_informe',
        'fecha_corte_periodo_informe',
    ];

    public function reciboPago()
    {
        return $this->belongsTo(Recibo::class, 'recibo_pagos_id');
    }
}
