<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
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

    public function alumno()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function subgrupos()
    {
        return $this->belongsTo(Subgrupos::class, 'clave_subgrupos_id');
    }
    public function paymentReceipt()
    {
        return $this->belongsTo(ReciboPagos::class, 'payment_receipt_id');
    }
}
