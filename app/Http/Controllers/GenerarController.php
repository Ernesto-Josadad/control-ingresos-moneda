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
        $students = Student::all(); // Obtiene todos los estudiantes
        $subGroups = Subgrupos::all(); // Obtiene todos los subgrupos
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
            ->join('alumnos', 'alumnos.id', '=', 'recibo_pagos.alumno_id')->get(); // Realiza una consulta para obtener los pagos
        return view('recibo_pagos.generar', compact('payment','students','subGroups')); // Devuelve la vista con los datos necesarios
    }

    public function savePayment(Request $request){
        $request->validate([
            'alumno_id' => 'required', // Valida que el alumno_id esté presente en la solicitud
            'folio' => 'required', // Valida que el folio esté presente en la solicitud
            'cantidad' => 'required', // Valida que la cantidad esté presente en la solicitud
            'total' => 'required', // Valida que el total esté presente en la solicitud
            'fecha' => 'required', // Valida que la fecha esté presente en la solicitud
            'detallePagos' => 'required|array', // Valida que detallePagos sea un arreglo y esté presente en la solicitud
            'detallePagos.*.pago_recibo_id' => 'required', // Valida que cada pago_recibo_id dentro de detallePagos esté presente
            'detallePagos.*.clave_subgrupo_id' => 'required', // Valida que cada clave_subgrupo_id dentro de detallePagos esté presente
            'detallePagos.*.importe' => 'required', // Valida que cada importe dentro de detallePagos esté presente
            'detallePagos.*.cantidad_subgrupo' => 'required' // Valida que cada cantidad_subgrupo dentro de detallePagos esté presente
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
