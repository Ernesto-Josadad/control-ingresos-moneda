<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->input('search');

        // Consulta base
        $studentsQuery = Student::query();

        // Aplicar filtro si se proporciona un término de búsqueda
        if ($search) {
            $studentsQuery->where('matricula', 'like', "%$search%")
                ->orWhere('nombres', 'like', "%$search%")
                ->orWhere('apellido_paterno', 'like', "%$search%")
                ->orWhere('apellido_materno', 'like', "%$search%")
                ->orWhere('grado', 'like', "%$search%")
                ->orWhere('grupo', 'like', "%$search%")
                ->orWhere('carrera', 'like', "%$search%");
        }

        // Obtener los estudiantes paginados
        $students = $studentsQuery->paginate(5);

        // Retornar la vista con los estudiantes y el término de búsqueda
        return view('students.students', compact('students', 'search'));
    }

    public function store(Request $request)
    {

        $student = new Student(); //Genero instancia de un nuevo registro conforme al modelo
        $student->matricula = $request->get('matricula'); //defino cada uno de los campos
        // apunto primero al registro del modelo y con el get traido el valor de lo que tengo en el name de la plantilla blade.
        $student->apellido_paterno = $request->get('apellido_paterno');
        $student->apellido_materno = $request->get('apellido_materno');
        $student->nombres = $request->get('nombres');
        $student->carrera = $request->get('carrera');
        $student->grado = $request->get('grado');
        $student->grupo = $request->get('grupo');
        $student->turno = $request->get('turno');
        $student->save(); //guardo el registro

        // Devuelve una respuesta JSON indicando el éxito y el mensaje
        return response()->json([
            'success' => true,
            'message' => 'El alumno se ha guardado correctamente.'
        ]);
    }

    public function show(string $id)
    {

        $student = Student::find($id); //Encuentro el registro conforme al ID
        return view('students.editStudent', compact('student')); //Retorno a la vista de editar

    }

    public function update(Request $request, string $id)
    {

        $student = Student::find($id); // encuentro el registro a actualizar
        $student->matricula = $request->get('matricula'); //defino cada uno de los campos
        // apunto primero al registro del modelo y con el get traido el valor de lo que tengo en el name de la plantilla blade.
        $student->nombres = $request->get('nombres');
        $student->apellido_paterno = $request->get('apellido_paterno');
        $student->apellido_materno = $request->get('apellido_materno');
        $student->carrera = $request->get('carrera');
        $student->grado = $request->get('grado');
        $student->grupo = $request->get('grupo');
        $student->turno = $request->get('turno');
        $student->save(); //guardo el registro

        // Establece un mensaje de sesión flash
        session()->flash('success_message', 'Los datos se han actualizado correctamente.');

        return redirect('/students'); //retorno a la vista enrutada. 
    }

    public function destroy(string $id)
    {

        $student = Student::find($id); //encuentro el registro
        $student->delete(); //lo elimino
        return redirect('/students'); //redirijo a la vista
    }
}
