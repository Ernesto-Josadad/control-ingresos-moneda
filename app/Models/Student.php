<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students'; // Nombre de la tabla en la base de datos
    public $primaryKey = 'id';
    protected $fillable = [
        'matricula', 
        'nombre', 
        'apellido_paterno',
        'apellido_materno',
        'grado',
        'grupo',
        'carrera'
    ]; 

}
