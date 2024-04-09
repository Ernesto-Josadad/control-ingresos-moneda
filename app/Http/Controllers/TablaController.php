<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\ReciboPagos;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

class TablaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->input('search');

        // Obtener los recibos de pago con los datos de los estudiantes cargados
        $recibosQuery = Recibo::with('alumno');

        // Aplicar filtro si se proporciona un término de búsqueda
        if ($search) {
            $recibosQuery->whereHas('alumno', function ($query) use ($search) {
                $query->where('matricula', 'like', "%$search%")
                      ->orWhere('nombres', 'like', "%$search%")
                      ->orWhere('apellido_paterno', 'like', "%$search%")
                      ->orWhere('apellido_materno', 'like', "%$search%")
                      ->orWhere('grado', 'like', "%$search%")
                      ->orWhere('grupo', 'like', "%$search%")
                      ->orWhere('carrera', 'like', "%$search%");
            });
        }

        // Paginar los resultados
        $recibos = $recibosQuery->paginate(10)->appends(['search' => $search]);


        // Obtener los datos de los recibos, incluidos los importes
        $datosRecibos = ReciboPagos::select('pago_recibo_id', 'clave_subgrupo_id', 'cantidad_subgrupo', 'importe')->get();

        // Convertir el total a palabras en español para los recibos
        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('es');

        foreach ($recibos as $recibo) {
            // Buscar el importe correspondiente al recibo actual
            $importeRecibo = $datosRecibos->where('pago_recibo_id', $recibo->id)->first();

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
        return view('tabla_grupos_subgrupos', compact('recibos', 'datosRecibos', 'currencyTransformer', 'search'));
    }
}
