<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;
    protected $table = 'clave_grupos';
    public $primaryKey = 'id';
    protected $fillable = [
        'clave',
        'concepto'
    ];
}
