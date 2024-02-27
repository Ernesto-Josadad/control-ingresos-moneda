<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator; 
use App\Models\Grupos; 

use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        return view('grupos_subgrupos');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'clavegrupo' => 'required',
    ]);

    if ($validator->fails()) {
        return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar todos los campos')
            ->withErrors($validator);
    } else {
        $grupo = clave_grupos::create([
            'clave_padre' => $request->clavegrupo,
        ]);
        return back()->with('Listo', 'Se ha agregado el grupo correctamente');
    }
}

    
}
