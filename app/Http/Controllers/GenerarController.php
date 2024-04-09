<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subgrupos;
use App\Models\Recibo;
use App\Models\ReciboPagos;
use Codedge\Fpdf\Fpdf\Fpdf;
use NumberFormatter;

class GenerarController extends Controller
{
    public function index()
    {
        $students = Student::all(); // Obtiene todos los estudiantes
        $subGroups = Subgrupos::all(); // Obtiene todos los subgrupos
        $payment = Recibo::all(); // Realiza una consulta para obtener los pagos
        return view('recibo_pagos.generar', compact('payment', 'students', 'subGroups')); // Devuelve la vista con los datos necesarios
    }

    public function savePayment(Request $request)
    {
        // Crear el Recibo
        $recibo = new Recibo();
        $recibo->alumno_id = $request->get('alumno_id');
        $recibo->folio = $request->get('folio');
        $recibo->cantidad = $request->get('cantidad');
        $recibo->total = $request->get('total');
        $recibo->fecha = $request->get('fecha');
        $recibo->save();
        //  Crear los Detalles de Pago 
        $detalesDePagos = $request->get('detallePagos');
        foreach ($detalesDePagos as $row) {
            ReciboPagos::create([
                'pago_recibo_id' => $recibo->id,
                'clave_subgrupo_id' => $row['clave_subgrupo_id'],
                'importe' => $row['importe'],
                'cantidad_subgrupo' => $row['cantidad_subgrupo'],
            ]);
        }

        return response()->json(['pago_recibo_id' => $recibo->id], 200);
    }

    public function verPDF($reciboId)
    {
        $pdf = $this->generarPDF($reciboId);
        return response()->file($pdf);
    }

    private function Conversion($numero)
    {
        $formatear = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        return ucfirst($formatear->format($numero));
    }

    private function generarPDF($reciboId)
    {
        // Obtenemos las relaciones del modelo
        $payment = Recibo::with(['alumno', 'detallePagos'])->findOrFail($reciboId);
        if (!$payment) {
            abort(404);
        }
        $alumno = $payment->alumno;
        // // Acceder a los detalles de pago relacionados
        // $detallePagos = $payment->detallePagos;

        // foreach ($detallePagos as $detallePago) {
        //     // Acceder al subgrupo asociado a este detalle de pago
        //     $subgrupo = $detallePago->subgrupos;
        //     // Ahora puedes acceder a los atributos del subgrupo, por ejemplo:
        //     $codigoSubgrupo = $subgrupo->codigo;
        //     $descripcionSubgrupo = $subgrupo->descripcion;
        //     $costoXSubgrupo = $subgrupo->costo;
        //     $importeXSubgrupo = $detallePago->importe;
        //     $cantidadSubgrupo = $detallePago->cantidad_subgrupo;

        // }

        $cantidadEnLetras = $this->Conversion($payment->total);


        // Formateo del folio para que solo tome los números
        $strFolio = $payment->folio;
        // Este es el que se imprime dentro del pdf 
        $folio = preg_replace("/[^0-9]/", "", $strFolio);
        $fecha_actual = date("d-m-Y");
        $fpdf = new FPDF('L');
        $fpdf->AddPage();
        $fpdf->Image('img/secretaria.png', 10, 7, -90);
        $fpdf->Image('img/texto_ingresos.png', -20, 50, -180);
        $fpdf->setfont('arial', '', 12);
        $fpdf->Cell(60, 6, '', 0, 0);
        $fpdf->Cell(145, 6, utf8_decode('SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR'), 0, 0, 'C');
        $fpdf->setfont('arial', 'B', 8);
        $fpdf->Cell(30, 6, 'UR', 1, 0, 'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, 'RECIBO No.', 1, 1, 'C');
        $fpdf->setfont('arial', '', 10);
        $fpdf->Cell(60, 6, '', 0, 0);
        $fpdf->Cell(145, 6, utf8_decode('Dirección General de Educación Tecnológica Agropeciaria y Ciencias del Mar'), 0, 0, 'C');
        $fpdf->setfont('arial', '', 7);
        $fpdf->Cell(30, 6, '610', 1, 0, 'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, 'DGETAYCM ' . $folio, 1, 1, 'C');
        $fpdf->setfont('arial', 'B', 14);
        $fpdf->Cell(277, 6, utf8_decode('RECIBO OFICIAL DE COBRO'), 0, 1, 'C');
        $fpdf->setfont('arial', '', 7);
        $fpdf->Cell(50, 6, '', 0, 0);
        $fpdf->Cell(155, 6, utf8_decode('R.F.C. SEP 210905778'), 0, 0, 'C');
        $fpdf->setfont('arial', 'B', 8);
        $fpdf->Cell(30, 6, 'FECHA', 1, 0, 'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, 'ENTIDAD FEDERATIVA', 1, 1, 'C');
        $fpdf->setfont('arial', '', 7);
        $fpdf->Cell(205, 6, utf8_decode('AVENIDA REPÚBLICA DE ARGENTINA, NUMERO EXTERIOR 28, NUMERO INTERIOR:OFICINA 1044'), 0, 0);
        $fpdf->setfont('arial', '', 7);
        $fpdf->Cell(30, 6, $fecha_actual, 1, 0, 'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, '31', 1, 1, 'C');
        $fpdf->Cell(277, 6, utf8_decode('COLONIA, CENTRO, C.P. 06010, DELEGACIÓN:CUAUHTÉMOC, ENTIDAD FEDERATIVA:CUIDAD DE MÉXICO'), 0, 1);
        $fpdf->setfont('arial', 'B', 10);
        $fpdf->Cell(277, 6, utf8_decode('RECIBÍ DE'), 0, 1, 'C');
        $fpdf->setfont('arial', '', 8);
        $fpdf->Cell(63, 6, utf8_decode($alumno->apellido_paterno), 'LTB', 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode($alumno->apellido_materno), 'TB', 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode($alumno->nombres), 'RTB', 0, 'C');
        $fpdf->Cell(18, 6, '', 0, 0);
        $fpdf->Cell(70, 6, utf8_decode('R.F.C. y/o MATRICULA'), 1, 1, 'C');

        $fpdf->setfont('arial', 'B', 8);
        $fpdf->Cell(63, 6, utf8_decode('APELLIDO PATERNO '), 1, 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode('APELLIDO MATERNO'), 1, 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode('NOMBRE (S)'), 1, 0, 'C');
        $fpdf->Cell(18, 6, '', 0, 0);
        $fpdf->Cell(70, 6, $alumno->matricula, 1, 1, 'C');

        //espacio vacio
        $fpdf->Cell(277, 6, '', 0, 1);

        //seccion 9
        $fpdf->Cell(198, 3, '', 'LRT', 0);
        $fpdf->Cell(16, 3, '', 0, 0);
        $fpdf->Cell(20, 3, '', 'LT', 0);
        $fpdf->Cell(23, 3, '', 'T', 0);
        $fpdf->Cell(20, 3, '', 'RT', 1);

        $fpdf->Cell(198, 3, 'CONOCIDO', 'LRB', 0, 'C');
        $fpdf->Cell(16, 10, '', 0, 0);
        $fpdf->Cell(20, 5, utf8_decode($alumno->grado), 'LRB', 0, 'C');
        $fpdf->Cell(23, 5, utf8_decode($alumno->grupo), 'LRB', 0, 'C');
        $fpdf->Cell(20, 5, utf8_decode($alumno->turno), 'LRB', 1, 'C');

        $fpdf->Cell(198, 5, '', 1, 0);
        $fpdf->Cell(16, 5, '', 0, 0);
        $fpdf->Cell(20, 5, utf8_decode('GRADO'), 1, 0);
        $fpdf->Cell(23, 5, utf8_decode('GRUPO'), 1, 0);
        $fpdf->Cell(20, 5, utf8_decode('TURNO'), 1, 1);



        //seccion 10
        $fpdf->setfont('arial', 'B', 7);
        $fpdf->Cell(25, 8, utf8_decode('LA CANTIDA ES $'), 'LTB', 0);
        $fpdf->Cell(40, 8, $payment->total, 'RTB', 1);
        $fpdf->Cell(212, 8, $cantidadEnLetras . ' Pesos', 1, 1, 'C');
        //espacio vacio
        $fpdf->Cell(277, 6, '', 0, 1);
        //SECCION 11
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, utf8_decode('CANTIDAD'), 0, 0, 'C');
        $fpdf->Cell(30, 6, utf8_decode('CLAVE'), 0, 0, 'C');
        $fpdf->Cell(105, 6, utf8_decode('CONCEPTO'), 0, 0, 'C');
        $fpdf->Cell(38, 6, utf8_decode('CUOTA'), 0, 0, 'C');
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, utf8_decode('IMPORTE'), 0, 1, 'C');

       
        // Acceder a los detalles de pago relacionados
        $detallePagos = $payment->detallePagos;

        // Iterar sobre los detalles de pago y generar las filas de la tabla en el PDF
        foreach ($detallePagos as $detallePago) {
            // Acceder al subgrupo asociado a este detalle de pago
            $subgrupo = $detallePago->subgrupos;
            // Ahora puedes acceder a los atributos del subgrupo, por ejemplo:
            $codigoSubgrupo = $subgrupo->codigo;
            $descripcionSubgrupo = $subgrupo->descripcion;
            $costoXSubgrupo = $subgrupo->costo;
            $importeXSubgrupo = $detallePago->importe;
            $cantidadSubgrupo = $detallePago->cantidad_subgrupo;

            // Generar una fila de la tabla por cada detalle de pago
            $fpdf->Cell(20, 6, '', 0, 0);
            $fpdf->Cell(30, 6, $cantidadSubgrupo, 1, 0, 'C');
            $fpdf->Cell(30, 6, $codigoSubgrupo, 1, 0, 'C');
            $fpdf->Cell(105, 6, $descripcionSubgrupo, 1, 0, 'C');
            $fpdf->Cell(38, 6, '$ ' . $costoXSubgrupo, 1, 0, 'C');
            $fpdf->Cell(4, 6, '', 0, 0);
            $fpdf->Cell(50, 6, '$ ' . $importeXSubgrupo, 1, 1, 'C');
        }

        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 'LTB', 0);
        $fpdf->Cell(30, 6, '', 'TB', 0);
        $fpdf->Cell(105, 6, '', 'RTB', 0);
        $fpdf->Cell(38, 6, '', 1, 0);
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, '', 1, 1);

        $fpdf->setfont('arial', 'B', 7);
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 1, 0);
        $fpdf->Cell(105, 6, '', 0, 0);
        $fpdf->Cell(38, 6, utf8_decode('TOTAL'), 0, 0, 'C');
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, '$ ' . $payment->total, 0, 1, 'C');

        //seccion 12
        $fpdf->setfont('arial', '', 7);
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(80, 6, utf8_decode('NOMBRE Y FIRMA DEL CAJERO'), 'LRT', 0, 'C');
        $fpdf->Cell(80, 6, utf8_decode('SELLO Y DATOS IMPRESOS DE LA ESCUELA'), 'LRT', 0, 'C');
        $fpdf->Cell(5, 6, '', 0, 0);
        $fpdf->Cell(92, 6, '', 1, 1);

        $fpdf->Cell(20, 13, '', 0, 0);
        $fpdf->Cell(80, 13, '', 'LR', 0);
        $fpdf->Cell(80, 13, '', 'LR', 0);
        $fpdf->Cell(5, 13, '', 0, 0);
        $fpdf->Cell(92, 13, '', 1, 1);

        $fpdf->Cell(20, 13, '', 0, 0);
        $fpdf->Cell(80, 13, '', 'LRT', 0);
        $fpdf->Cell(80, 13, '', 'LR', 0);
        $fpdf->Cell(5, 13, '', 0, 0);
        $fpdf->Cell(92, 13, '', 1, 1);

        $fpdf->Cell(20, 4, '', 0, 0);
        $fpdf->Cell(80, 4, 'M.E. JORGE CARLOS AZCORRA OSORIO', 'LRB', 0, 'C');
        $fpdf->Cell(80, 4, '', 'LRB', 0);
        $fpdf->Cell(5, 4, '', 0, 0);
        $fpdf->Cell(92, 4, '', 1, 1);
        $fpdf->Image('img/SAT.png', 195, 144, -185);


        //encabezado
        $fpdf->setfont('arial', '', 6);
        $fpdf->Cell(277, 7, utf8_decode('NOTA: CARECE DE VALIDEZ COMO COMPROBANTE DE PAGO SI NO TIENE SELLO DE LA ESCUELA Y FIRMA DEL CAJERO EXENTO DE I.V.A. CONFORME AL ART. 15 FRACC. IV DE LA LEY DE IMPUESTO AL VALOR AGREGADO'), 0, 1, 'C');

        $fpdf->Output();
        exit;
    }
}
