<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Grupos;
use App\Models\ReciboPagos;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use App\Models\Reporte_mensual;
use App\Http\Controllers\Controller;

class ReporteMensualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Recogemos todos los registros generados desde el día 1 hasta la fecha actual del mes
        $fecha_actual = Carbon::now();
        $fecha_inicio_mes = $fecha_actual->copy()->startOfMonth();
        $recibos = ReciboPagos::where('created_at', '>=', $fecha_inicio_mes)->get();

        //Contamos la cantidad de folios utilizados
        $totalFolios = $recibos->pluck('folio')->count();
        //Sumamos los ingresos del mes
        $totalSum = $recibos->pluck('total')->sum();

        //Imprimimos el folio inical del mes
        $primerRecibo = $recibos->sortBy('created_at')->first();
        $folioInicial = $primerRecibo ? $primerRecibo->folio : null;

        //Imprimimos el folio final del mes
        $ultimoRecibo = $recibos->sortByDesc('created_at')->first();
        $folioFinal = $ultimoRecibo ? $ultimoRecibo->folio : null;

        //Imprimimos la fecha de inicio
        $fechaInicialFormateada = $fecha_inicio_mes->format('d-M-y');

        //Imprimimos la fecha final y al mismo tiempo se utiliza como fecha de elaboracion
        $fechaFinalFormateada = $fecha_actual->format('d-M-y');

        //Recogemos los datos de los grupos
        $grupos = Grupos::all('clave');

        //Retornamos la vista
        return view('reporteMensual/index', compact(
            'recibos',
            'totalSum',
            'totalFolios',
            'folioInicial',
            'folioFinal',
            'fechaInicialFormateada',
            'fechaFinalFormateada',
            'grupos',
        ));
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
