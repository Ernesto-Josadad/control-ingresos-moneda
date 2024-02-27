<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subgrupo;

class SubgruposController extends Controller
{
    public function index()
    {
        $subgroups = Subgroup::all();
        return view('grupos_subgrupos');
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clavesubgrupo' => 'required',
            'descripcionsubgrupo' => 'required',
            'costosubgrupo' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->with('ErrorInsert', 'Favor de llenar todos los campos')
                ->withErrors($validator);
        } else {
            $subgrupo = Subgroup::create([
                'clave_hijo' => $request->clavesubgrupo,
                'concepto' => $request->descripcionsubgrupo,
                'costo' => $request->costosubgrupo,
            ]);

            return back()->with('Listo', 'Se ha agregado el subgrupo correctamente');
        }
    }
}