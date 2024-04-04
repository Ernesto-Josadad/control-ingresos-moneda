<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\ReciboPagos;
use App\Models\Student; // Agregar el modelo Student
use NumberToWords\NumberToWords;

class TablaController extends Controller
{
    public function index()
    {
        // Obtener todos los recibos de pago con los datos de los estudiantes cargados
        // Agregar paginación
        $recibos = Recibo::with('alumno')->paginate(10);

        // Obtener los datos de los recibos, incluidos los importes
        $datosRecibos = ReciboPagos::select('recibo_pago_id', 'clave_subgrupo_id', 'cantidad_subgrupo', 'importe')->get();

        // Convertir el total a palabras en español para los recibos
        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('es');

        foreach ($recibos as $recibo) {
            // Buscar el importe correspondiente al recibo actual
            $importeRecibo = $datosRecibos->where('recibo_pago_id', $recibo->id)->first();

            // Asignar el importe al recibo si se encuentra
            if ($importeRecibo) {
                $recibo->importe = $importeRecibo->importe;
            } else {
                $recibo->importe = 'No disponible';
            }

            // Convertir el total a palabras
            $recibo->totalEnLetras = ucfirst($currencyTransformer->toWords($recibo->total * 100, 'MXN'));
        }

        // Pasar los datos de los recibos y sus importes a la vista
        return view('tabla_grupos_subgrupos', compact('recibos', 'datosRecibos', 'currencyTransformer'));
    }
    
}