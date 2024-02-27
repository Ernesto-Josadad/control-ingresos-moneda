<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;
    protected $table = 'payments'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'student_id', 
        'payment_receipt_id', 
        'group_id', 
        'clave_pago',
        'total'
    ]; 

    public function alumno()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }
    public function paymentReceipt()
    {
        return $this->belongsTo(ReciboPagos::class, 'payment_receipt_id');
    }
}
