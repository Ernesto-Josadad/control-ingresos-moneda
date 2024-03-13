<?php
namespace App\Http\Controllers;

use App\Models\Grupos;
use App\Models\Subgrupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        $cgrupos = Grupos::all();


        return view('nuevogrupo', compact('cgrupos'));
    }

    public function store(Request $request)
    {
        $grupo = new Grupos();

        $grupo->clave = $request->get('clave');
        $grupo->concepto = $request->get('concepto');
        $grupo->save();
        return redirect('/nuevogrupo');
    }
}
