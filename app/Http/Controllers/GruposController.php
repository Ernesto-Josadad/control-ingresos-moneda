<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use App\Models\Subgrupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    // Método para mostrar todos los grupos
    public function index()
    {
        $cgrupos = Grupos::all(); // Recupera todos los grupos de la base de datos
        return view('nuevogrupo', compact('cgrupos')); // Devuelve la vista 'nuevogrupo' con los grupos recuperados
    }

    // Método para almacenar un nuevo grupo
    public function store(Request $request)
    {
        $grupo = new Grupos(); // Crea una nueva instancia de Grupos

        // Asigna los valores del formulario al nuevo grupo
        $grupo->clave = $request->get('clave');
        $grupo->concepto = $request->get('concepto');

        $grupo->save(); // Guarda el nuevo grupo en la base de datos

        return redirect('/nuevogrupo'); // Redirige a la vista 'nuevogrupo'
    }

    // Método para mostrar el formulario de edición de un grupo
    public function show(string $id)
    {
        $cgrupos = Grupos::find($id); // Busca el grupo con el ID proporcionado
        return view('editnuevogrupo', compact('cgrupos')); // Devuelve la vista 'editnuevogrupo' para editar el grupo
    }

    // Método para actualizar un grupo existente
    public function update(Request $request, string $id)
    {
        $cgrupos = Grupos::find($id); // Busca el grupo a actualizar

        // Actualiza los valores del grupo con los datos del formulario
        $cgrupos->clave = $request->get('clave');
        $cgrupos->concepto = $request->get('concepto');

        $cgrupos->save(); // Guarda los cambios en la base de datos

        return redirect('/nuevogrupo'); // Redirige a la vista 'nuevogrupo'
    }

    // Método para eliminar un grupo
    public function destroy(string $id)
    {
        $cgrupos = Grupos::find($id); // Busca el grupo a eliminar
        $cgrupos->delete(); // Elimina el grupo de la base de datos
        return redirect('/nuevogrupo'); // Redirige a la vista 'nuevogrupo'
    }
}

