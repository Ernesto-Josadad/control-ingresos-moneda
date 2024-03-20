<?php

namespace App\Http\Controllers;

use Fpdf\Fpdf;
use Carbon\Carbon;
use App\Models\Grupos;
use App\Models\Recibo;
use App\Models\Subgrupos;
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
        // Obtener todos los reportes mensuales
        $reportesMensuales = Reporte_mensual::all();

        // Pasar los reportes a la vista
        return view('reporteMensual.reporte_mensual', compact('reportesMensuales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // * Recogemos todos los registros generados desde el día 1 hasta la fecha actual del mes
        $fecha_actual = Carbon::now();
        $fecha_inicio_mes = $fecha_actual->copy()->startOfMonth();
        $recibos = ReciboPagos::where('created_at', '>=', $fecha_inicio_mes)->get();

        // * Obtenemos los ids de los recibos para buscar los pagos asociados
        $reciboIds = $recibos->pluck('pago_recibo_id');

        // * Obtenemos los pagos asociados a los recibos
        $pagosRecibo = Recibo::whereIn('id', $reciboIds)->get();

        // * Contamos la cantidad de folios utilizados
        $totalFolios = $pagosRecibo->pluck('folio')->count();

        // Calcular saldo del mes anterior
        $saldo_mes_anterior = Reporte_mensual::where('fecha_final_del_mes', '<', $fecha_inicio_mes)
            ->orderByDesc('fecha_final_del_mes')
            ->value('saldo_mes'); // Calcular saldo del mes anterior
        // $saldo_mes_anterior = Reporte_mensual::where('fecha_final_del_mes', '<', $fecha_inicio_mes)
        //     ->orderByDesc('fecha_final_del_mes')
        //     ->value('saldo_mes');

        // * Calcular total de ganancias del mes actual
        $totalSum = $pagosRecibo->pluck('total')->sum();

        // * Sumar saldo del mes anterior al total de ganancias del mes actual para obtener el saldo del mes actual
        $saldo_mes = $saldo_mes_anterior + $totalSum;

        // ! Obtener el año en el que se realizó el informe
        $anio_informe = $fecha_inicio_mes->year;

        // ! Obtenemos la fecha de creación y formateamos la fecha en el formato "dd/mm/yyyy"
        $fecha_creacion = $fecha_actual->format('d/m/Y');

        // ! Obtener el nombre del mes en el que se está realizando el informe
        $nombre_mes_informe = strtoupper($fecha_inicio_mes->translatedFormat('F'));

        // ! Obtenemo e imprimimos el folio inical del mes
        $primerRecibo = $pagosRecibo->sortBy('created_at')->first();
        $folioInicial = $primerRecibo ? $primerRecibo->folio : null;

        // ! Obtenemos e imprimimos el folio final del mes
        $ultimoRecibo = $pagosRecibo->sortByDesc('created_at')->first();
        $folioFinal = $ultimoRecibo ? $ultimoRecibo->folio : null;


        // * Imprimimos la fecha de inicio
        $fechaInicialFormateada = $fecha_inicio_mes->format('d-M-y');

        // * Imprimimos la fecha final y al mismo tiempo se utiliza como fecha de elaboracion
        $fechaFinalFormateada = $fecha_actual->format('d-M-y');

        // TODO:     LOGICA DE LA DIVISION DE UTILIDADES POR GRUPOS Y SUBGRUPOS

        // ? Recogemos los datos de los grupos
        $grupos = Grupos::all()->keyBy('id');

        // ? Obtenemos los ids de los subgrupos
        $subgruposIds = $recibos->pluck('clave_subgrupo_id');

        // ! Obtenemos los subgrupos asociados a los recibos
        $subgrupos = Subgrupos::whereIn('id', $subgruposIds)->get();

        // TODO: Inicializar un array para almacenar las ganancias por subgrupo
        $gananciasPorSubgrupo = [];

        // TODO: Obtener los subgrupos con sus datos
        $subgrupos = Subgrupos::all()->keyBy('id');

        // ! Calcular las ganancias por subgrupo
        foreach ($recibos as $recibo) {
            $subgrupoId = $recibo->clave_subgrupo_id;
            $grupoId = $subgrupos[$subgrupoId]->clave_grupo_id;

            //  TODO:Construir la clave del grupo (clave) seguido del concepto
            $grupoInfo = $grupos[$grupoId]->clave . ' > ' . $grupos[$grupoId]->concepto;

            // TODO: Construir la clave del subgrupo (codigo) seguido de la descripción
            $subgrupoInfo = $subgrupos[$subgrupoId]->codigo . ' - ' . $subgrupos[$subgrupoId]->descripcion;

            // TODO: Combinar la información del grupo y el subgrupo
            $infoCompleta = $grupoInfo . ' < ' . $subgrupoInfo;

            // TODO: Almacenar la información completa en el array de ganancias por subgrupo
            if (!isset($gananciasPorSubgrupo[$infoCompleta])) {
                $gananciasPorSubgrupo[$infoCompleta] = 0;
            }

            // ? Sumar el costo del subgrupo multiplicado por la cantidad de subgrupos
            $costoSubgrupo = $subgrupos[$subgrupoId]->costo;
            $cantidadSubgrupos = $recibo->cantidad_subgrupo;
            $gananciasPorSubgrupo[$infoCompleta] += $costoSubgrupo * $cantidadSubgrupos;

            // ? Sumar las ganancias del subgrupo al total de ingresos del grupo
            if (!isset($ingresosPorGrupo[$grupoId])) {
                $ingresosPorGrupo[$grupoId] = 0;
            }
            $ingresosPorGrupo[$grupoId] += $costoSubgrupo * $cantidadSubgrupos;
        }

        // Ordenar el array por claves de forma ascendente
        ksort($gananciasPorSubgrupo);

        // TODO: Crear una nueva instancia del modelo Reporte_mensual
        $reporteMensual = new Reporte_mensual();

        // ? Llenar los campos con los resultados obtenidos
        $reporteMensual->ingresos = $totalSum;
        $reporteMensual->cantidad_de_folios = $totalFolios;
        $reporteMensual->folio_inicial = $folioInicial;
        $reporteMensual->folio_final = $folioFinal;
        $reporteMensual->fecha_inicial_del_mes = $fechaInicialFormateada;
        $reporteMensual->fecha_final_del_mes = $fechaFinalFormateada;
        $reporteMensual->ganancias_por_subgrupo = $gananciasPorSubgrupo = json_encode($gananciasPorSubgrupo);
        $reporteMensual->grupos = $grupos = json_encode($grupos);
        $reporteMensual->ganancias_por_grupo = $ingresosPorGrupo = json_encode($ingresosPorGrupo);
        $reporteMensual->ejercicio_fiscal = $anio_informe;
        $reporteMensual->periodo_de_informe = $nombre_mes_informe;
        $reporteMensual->fecha_de_elaboracion = $fecha_creacion;
        $reporteMensual->total_disponible = $saldo_mes;


        // * Guardamos los datos en la base de datos



        $reporteMensual->save();

        return redirect()->route('reporte');
    }

    public function search(Request $request)
    {
        //
    }

    // !

    public function generarPDF(Request $request)
    {

        // TODO: TOMANDO LOS DATOS ALMACENADOS PARA EL REPORTE

        // Obtener el ID del reporte seleccionado
        $id = $request->input('id');

        // Buscar el reporte en la base de datos por su ID
        $reporte = Reporte_mensual::find($id);

        if (!$reporte) {
            // Si no se encuentra el reporte, redirecciona o muestra un mensaje de error
            return redirect()->route('reporte')->with('error', 'No se encontró el reporte.');
        }

        $gananciasPorSubgrupo = json_decode($reporte->ganancias_por_subgrupo, true);

        // ! Iniciando un objeto

        $pdf = new Fpdf();

        // TODO: AGREGANDO UNA PAGINA

        $pdf->AliasNbPages();

        $pdf->AddPage('','A4');

        // ? Establecer una fuente
        $pdf->SetFont('Courier', '', 10);

        // ! CUERPO

        $pdf->Image('img/secretaria.png', 10, 7, -90);
        $pdf->Ln(25);

        // TODO Títulos de la tabla
        $pdf->SetFont('Arial', 'B', 8.5);
        $pdf->Cell(45, 7, 'CLAVE DEL PLANTEL', 1, 0, 'C');
        $pdf->Cell(45, 7, 'EJERCICIO FISCAL', 1, 0, 'C');
        $pdf->Cell(45, 7, 'PERIODO DE INFORME', 1, 0, 'C');
        $pdf->Cell(45, 7, 'FECHA DE ELABORACION', 1, 0, 'C');
        $pdf->Ln();
        // ? Agregar datos obtenidos del reporte
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(45, 7, '31DTA0284Z', 1, 0, 'C'); // Clave del plantel
        $pdf->Cell(45, 7, $reporte->ejercicio_fiscal, 1, 0, 'C');
        $pdf->Cell(45, 7, $reporte->periodo_de_informe, 1, 0, 'C');
        $pdf->Cell(45, 7, $reporte->fecha_de_elaboracion, 1, 1, 'C'); // MultiCell para permitir saltos de línea

        // Separación entre las dos tablas
        $pdf->Ln(10);

        $cadenaDatos = Reporte_mensual::pluck('ganancias_por_subgrupo')->first();
        $datos = json_decode($cadenaDatos, true);
        $datosAgrupados = [];
        foreach ($datos as $descripcion => $cantidad) {
            list($grupo, $subgrupo) = explode(' < ', $descripcion);
            $datosAgrupados[$grupo][] = [$subgrupo, $cantidad];
        }

        //CONTENIDO DE TABLA
        // Iterar sobre los datos agrupados y agregarlos al PDF
        foreach ($datosAgrupados as $grupo => $subgrupos) {
            $pdf->Cell(180, 7, $grupo, '{T, L, R}', 1);
            foreach ($subgrupos as $subgrupo) {
                // ? $pdf->Cell(180, 10, '', '{L}', 1);
                $pdf->Cell(180, 10, '       ' . $subgrupo[0] . ':       ' . '$' . $subgrupo[1], '{R, L}', 1);
            }
        }
        $pdf->Cell(170, 0, '', '{T}', 1);
        // TODO: CELDAS SIN MARGEN
        $pdf->Cell(50, 7, '', 0, 0, '', 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 7, 'SUMAS IGUALES', 0, 0, 'C');
        $pdf->SetFont('Arial', '', 10);
        // TODO: CELDAS CON MARGEN
        $pdf->Cell(40, 7, $reporte->ingresos, 1, 0, 'C');
        $pdf->Cell(40, 7, $reporte->ingresos, 1, 1, 'C');

        $pdf->Ln(10);

        // ? NUEVA TABLA

        // * TITULO
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(180, 7, 'MOVIMIENTOS DE LA CUENTA DE CAJA', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);

        // TODO: CELDAS SIN MARGEN
        $pdf->Cell(70, 7, 'SALDO DEL MES ANTERIOR:', '{T, L}', 0, 'C');
        $pdf->Cell(30, 7, '', '{T}', 0, '', 0);
        $pdf->Cell(40, 7, $reporte->total_disponible, '{T, B}', 0, 'C');
        $pdf->Cell(40, 7, '', '{T, R}', 0, '', 0);
        $pdf->Ln();

        // TODO: CELDAS SIN MARGEN
        $pdf->Cell(60, 7, 'INGRESOS', '{L}', 0, 'C', 0);
        $pdf->Cell(40, 7, '', '', 0, '', 0);
        $pdf->Cell(40, 7, $reporte->ingresos, '{B}', 0, 'C', 0);
        $pdf->Cell(40, 7, '', '{R}', 0, 'C', 0);
        $pdf->Ln();

        // TODO: CELDAS SIN MARGEN
        $pdf->Cell(60, 7, 'TOTAL DISPONIBLE:', '{B, L}', 0, 'C');
        $pdf->Cell(40, 7, '', '{B}', 0, '', 0);
        $pdf->Cell(40, 7, $reporte->total_disponible, '{B}', 0, 'C');
        $pdf->Cell(40, 7, '', '{R,B}', 0, '', 0);

        $pdf->Ln(20);

        // !Añadimos nueva página

        // * TITULO
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(180, 10, 'FOLIOS DE RECIBOS OFICIALES DE COBROS CANCELADOS EN EL MES:', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 8.5);
        // TODO: CELDAS SIN MARGEN
        $pdf->Cell(80, 7, utf8_decode('FOLIOS ASIGNADOS EN LA ÚLTIMA DOTACIÓN:'), '{L,T,B}', 0, 'C');
        $pdf->Cell(100, 7, utf8_decode('TOTAL DE FOLIOS UTILIZADOS EN EL MES'), '{R,T,B}', 1, 0);
        // TODO: CELDAS SIN MARGEN
        $pdf->Cell(36, 7, 'INICIAL', '{L}', 0, 'C');
        $pdf->Cell(36, 7, 'FINAL', 0, 0, 'C');
        //
        $pdf->Cell(36, 7, 'CANTIDAD', 0, 0, 'C');
        $pdf->Cell(36, 7, 'DEL', 0, 0, 'C', 0);
        $pdf->Cell(36, 7, 'AL', '{R}', 0, 'C', 0);
        $pdf->Ln();

        // TODO: CELDAS SIN MARGEN
        $pdf->SetFont('Arial', 'U', 10);
        $pdf->Cell(36, 7, $reporte->folio_inicial, '{L, B}', 0, 'C', 0);
        $pdf->Cell(36, 7, $reporte->folio_final, '{B}', 0, 'C', 0);
        $pdf->Cell(36, 7, $reporte->cantidad_de_folios, '{B}', 0, 'C', 0);
        // !
        $pdf->Cell(36, 7,  $reporte->fecha_inicial_del_mes, '{B}', 0, 'C', 0);
        $pdf->Cell(36, 7,  $reporte->fecha_final_del_mes, '{R,B}', 1, 'C',);
        $pdf->Ln(10);

        // TODO: Inicializamos nueva tabla
        //? HEADER
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(90, 7, 'SELLO CON LOS DATOS DEL PLANTEL', 1, 0, 'C');
        $pdf->Cell(20, 7, '', 0, 0, 'C');
        $pdf->Cell(70, 7, 'EL DIRECTOR DEL PLANTEL', 1, 1, 'C');

        //? ESPACIO PARA LA FIRMA
        $pdf->Cell(90, 40, '', 1, 0, 'C');
        $pdf->Cell(20, 40, '', 0, 0, 'C');
        $pdf->Cell(70, 40, '', 1, 1, 'C');
        //? FOOTER
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(90, 7, 'EL SELLO SERA LEGIBLE Y EL QUE SE EMPLEA EN LOS R.O.C.', 1, 0, 'C');
        $pdf->Cell(20, 7, ' ', 0, 0, 'C');
        $pdf->Cell(70, 7, utf8_decode('M.E ANGÉLICA MARÍA CASTILLO LÓPEZ'), 1, 1, 'C');




        // Centrar la tabla en el documento
        $pdf->SetY(($pdf->GetPageHeight() - $pdf->GetY()) / 2 - 40);


        // ! CIERRE DEL CUERPO

        // TODO: CIERRE

        $pdf->Output();
        exit;
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
