<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subgrupos;
use App\Models\Recibo;
use App\Models\ReciboPagos;

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

    public function savePayment(Request $request){
        $request->validate([
            'alumno_id' => 'required',
            'folio' => 'required',
            'cantidad' => 'required',
            'total' => 'required',
            'fecha' => 'required',
            'detallePagos' => 'required|array',
            'detallePagos.*.pago_recibo_id' => 'required',
            'detallePagos.*.clave_subgrupo_id' => 'required',
            'detallePagos.*.importe' => 'required',
            'detallePagos.*.cantidad_subgrupo' => 'required'
        ]);

        // Creamos un nuevo recibo
        $recibo = Recibo::create([
            'alumno_id' => $request->alumno_id,
            'folio' => $request->folio,
            'cantidad' => $request->cantidad,
            'total' => $request->total,
            'fecha' => $request->fecha,
        ]);

        //  Crear los Detalles de Pago 
    foreach ($request->detallePagos as $detallePagoData) {
        $detallePagos = new ReciboPagos([
            'pago_recibo_id' => $recibo->id,
            'clave_subgrupo_id' => $detallePagoData['clave_subgrupo_id'],
            'importe' => $detallePagoData['importe'],
            'cantidad_subgrupo' => $detallePagoData['cantidad_subgrupo'],
        ]);

        // Guardar tanto el Pago como el Detalle del Pago
        $recibo->detallePagos()->save($detallePagos);
    }

        return response()->json(['message' => 'Datos guradados correctamente'], 200);
    }

    

}
