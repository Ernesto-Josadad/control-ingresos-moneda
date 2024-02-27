<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboPagos extends Model
{
    use HasFactory;
    protected $table = 'payment_receipts'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'folio', 
        'administrator_id', 
        'num_recibo', 
        'entidad_federativa',
        'ur'
    ];
}
