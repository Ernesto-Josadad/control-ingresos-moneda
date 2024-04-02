<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subgrupos;
use App\Models\Grupos;

class SubgruposController extends Controller
{
    // Método para mostrar todos los subgrupos
    public function index()
    {
        $csubgrupos = Subgrupos::paginate(5); // Recupera todos los subgrupos de la base de datos
        $grupos = Grupos::all(); // Recupera todos los grupos de la base de datos
        return view('grupos_subgrupos', compact('csubgrupos', 'grupos')); // Devuelve la vista 'grupos_subgrupos' con los subgrupos y grupos recuperados
    }

    // Método para almacenar un nuevo subgrupo
    public function store(Request $request)
    {
        $subgrupo = new Subgrupos(); // Crea una nueva instancia de Subgrupos

        // Asigna los valores del formulario al nuevo subgrupo
        $subgrupo->clave_grupo_id = $request->get('clave_grupo_id');
        $subgrupo->codigo = $request->get('codigo');
        $subgrupo->descripcion = $request->get('descripcion');
        $subgrupo->costo = $request->get('costo');

        $subgrupo->save(); // Guarda el nuevo subgrupo en la base de datos

        // Devuelve una respuesta JSON indicando el éxito y el mensaje
        return response()->json([
            'success' => true,
            'message' => 'El subgrupo se ha guardado correctamente.'
        ]);
    }

    // Método para mostrar el formulario de edición de un subgrupo
    public function show(string $id)
    {
        $csubgrupos = Subgrupos::find($id); // Busca el subgrupo con el ID proporcionado
        $grupos = Grupos::all(); // Obtener todos los grupos
        return view('editgrupos_subgrupos', compact('csubgrupos', 'grupos')); // Devuelve la vista 'editgrupos_subgrupos' para editar el subgrupo
    }

    // Método para actualizar un subgrupo existente
    public function update(Request $request, string $id)
    {
        $subgrupo = Subgrupos::find($id); // Busca el subgrupo a actualizar

        // Actualiza los valores del subgrupo con los datos del formulario
        $subgrupo->clave_grupo_id = $request->get('clave_grupo_id');
        $subgrupo->codigo = $request->get('codigo');
        $subgrupo->descripcion = $request->get('descripcion');
        $subgrupo->costo = $request->get('costo');

        $subgrupo->save(); // Guarda los cambios en la base de datos

        // Establece un mensaje de sesión flash
        session()->flash('success_message', 'Los datos se han actualizado correctamente.');

        return redirect('/grupos_subgrupos'); // Redirige a la vista 'grupos_subgrupos'
    }

    // Método para eliminar un subgrupo
    public function destroy(string $id)
    {
        $csubgrupos = Subgrupos::find($id); // Busca el subgrupo a eliminar
        $csubgrupos->delete(); // Elimina el subgrupo de la base de datos
        return redirect('/grupos_subgrupos'); // Redirige a la vista 'grupos_subgrupos'
    }
}
