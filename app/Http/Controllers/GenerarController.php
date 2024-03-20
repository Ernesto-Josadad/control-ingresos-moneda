<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subgrupos;
use App\Models\Recibo;

class GenerarController extends Controller
{
    public function index()
    {
        //
        $students = Student::all();
        $subGroups = Subgrupos::all();
        $payment = Recibo::select(
            'alumno_id',
            'matricula',
            'apellido_paterno',
            'apellido_materno',
            'nombres',            
            'folio',
            'cantidad',
            'fecha',
            'total',
            
        )
            ->join('alumnos', 'alumnos.id', '=', 'recibo_pagos.alumno_id')->get();
        return view('recibo_pagos.generar', compact('payment','students','subGroups'));
    }

}
