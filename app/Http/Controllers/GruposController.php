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
        $cgrupos = Grupos::paginate(5); // Cambia 10 por el número de registros que deseas mostrar por página
        return view('nuevogrupo', compact('cgrupos'));
    }

// Método para almacenar un nuevo grupo
public function store(Request $request)
{
    $grupo = new Grupos(); // Crea una nueva instancia de Grupos

    // Asigna los valores del formulario al nuevo grupo
    $grupo->clave = $request->get('clave');
    $grupo->concepto = $request->get('concepto');

    $grupo->save(); // Guarda el nuevo grupo en la base de datos

    // Devuelve una respuesta JSON indicando el éxito y el mensaje
    return response()->json([
        'success' => true,
        'message' => 'El grupo se ha guardado correctamente.'
    ]);
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

    // Establece un mensaje de sesión flash
    session()->flash('success_message', 'Los datos se han actualizado correctamente.');

    // Redirige a la vista 'nuevogrupo'
    return redirect('/nuevogrupo');
}

    // Método para eliminar un grupo
    public function destroy(string $id)
    {
        $cgrupos = Grupos::find($id); // Busca el grupo a eliminar
        $cgrupos->delete(); // Elimina el grupo de la base de datos
        return redirect('/nuevogrupo'); // Redirige a la vista 'nuevogrupo'
    }
}

