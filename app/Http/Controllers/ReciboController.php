<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use App\Models\Recibo;
use App\Models\Subgrupos;
use App\Models\ReciboPagos;
use App\Models\Student;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $student = Student::all();
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
        return view('recibo_pagos.recibo', compact('payment', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $payment = new Recibo();
        $payment->pago_recibo_id = $request->get('pago_recibo_id');
        $payment->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showPDF($paymentId)
    {
        $pdf = $this->generatePDF($paymentId);
        return response()->file($pdf);
    }



    public function ultimoFolio(){
        $ultimaConsulta = Recibo::latest('folio')->first();

        if ($ultimaConsulta) {
            // Obtener el número del folio eliminando los espacios en blanco
            $numeroFolio = (int)str_replace(' ', '', explode(' ', $ultimaConsulta->folio)[1]);

            return $numeroFolio;
        } else {
            return null;
        }
    }

    
}
