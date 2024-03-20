<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;
    protected $table = 'pago_recibo'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'alumno_id',
        'folio',
        'cantidad',
        'total',
        'fecha'
    ];

    public function detallePagos()
    {
        return $this->hasMany(ReciboPagos::class);
    }
}
