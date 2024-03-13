<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subgrupos;
use App\Models\Grupos;

class SubgruposController extends Controller
{
    public function index()
{
    $grupos= Grupos::all();
    $csubgroup = Subgrupos::select (
        'clave_grupo_id',
        'clave',
        'concepto',
        'codigo',
        'descripcion',
        'costo'

    )
    ->join('clave_grupos','clave_grupos.id','=', 'clave_subgrupos.clave_grupo_id')->get();
    return view('grupos_subgrupos', compact('csubgroup','grupos'));
}

    public function store(Request $request)
    {
        $subgrupo = new Subgrupos();

        $subgrupo->clave = $request->get('codigo');
        $subgrupo->concepto = $request->get('descripcion');
        $subgrupo->concepto = $request->get('costo');
        $subgrupo->save();
        return redirect('/grupos_subgrupos');

    }
}