<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte_mensual extends Model
{
    use HasFactory;
    protected $table = 'ingresos'; // Nombre de la tabla

    protected $fillable = [
        'ingresos',
        'cantidad_de_folios',
        'folio_inicial',
        'folio_final',
        'fecha_inicial_del_mes',
        'fecha_final_del_mes',
        'ganancias_por_subgrupo',
        'grupos',
        'ganancias_por_grupo',
        'ejercicio_fiscal',
        'periodo_de_informe',
        'fecha_de_elaboracion',
        'total_disponible',
    ];

    public function reciboPago()
    {
        return $this->belongsTo(Recibo::class, 'recibo_pagos_id');
    }
    public function clave_grupos()
    {
        return $this->belongsTo(Grupos::class, 'clave_grupos_id');
    }

    public function clave_subgrupos()
    {
        return $this->belongsTo(Subgrupos::class, 'clave_subgrupo_id');
    }
}
