<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ReciboPagos;
use Illuminate\Http\Request;
use App\Models\Reporte_mensual;
use App\Http\Controllers\Controller;

class ReporteMensualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fecha_actual = Carbon::now();
        $fecha_inicio_mes = $fecha_actual->copy()->startOfMonth();
        $recibos = ReciboPagos::where('created_at', '>=', $fecha_inicio_mes)->get();
        return view('reporte_mensual.index', compact('recibos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporte_mensual $reporte_mensual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte_mensual $reporte_mensual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte_mensual $reporte_mensual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte_mensual $reporte_mensual)
    {
        //
    }
}
