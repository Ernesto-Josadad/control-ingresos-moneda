<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Recibo extends Model
{
    use HasFactory;
    protected $table = 'recibo_pago'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'alumno_id',
        'folio',
        'cantidad',
        'total',
        'fecha'
    ];


    public function alumno()
    {
        return $this->belongsTo(Student::class, 'alumno_id');
    }

    public function subgrupos()
    {
        return $this->belongsTo(Subgrupos::class, 'clave_subgrupos_id');
    }
    public function detallePagos()
    {
        return $this->hasMany(ReciboPagos::class);
    }

    // public function alumno()
    // {
    //     return $this->belongsTo(Student::class, 'alumno_id');
    // }
    // public function subgrupos()
    // {
    //     return $this->belongsTo(Subgrupos::class, 'clave_subgrupo_id');
    // }
    // public function recibopagos()
    // {
    //     return $this->belongsTo(ReciboPagos::class, 'payment_receipt_id');
    // }

}
