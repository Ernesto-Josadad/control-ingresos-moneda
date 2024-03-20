<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::Paginate(1);
        return view('students.students',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $student= new Student(); //Genero instancia de un nuevo registro conforme al modelo
        $student->matricula = $request->get('matricula'); //defino cada uno de los campos
        // apunto primero al registro del modelo y con el get traido el valor de lo que tengo en el name de la plantilla blade.
        $student->apellido_paterno = $request->get('apellido_paterno');
        $student->apellido_materno = $request->get('apellido_materno');
        $student->nombres=$request->get('nombres');
        $student->carrera = $request->get('carrera');
        $student->grado = $request->get('grado');
        $student->grupo = $request->get('grupo');
        $student->turno = $request->get('turno');
        $student->save(); //guardo el registro
        return redirect('/students'); //retorno a la vista ya enrutada para que recargue y muestre el registro 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $student = Student::find($id); //Encuentro el registro conforme al ID
        return view('students.editStudent', compact('student')); //Retorno a la vista de editar

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $student = Student::find($id); // encuentro el registro a actualizar
        $student->matricula = $request->get('matricula'); //defino cada uno de los campos
        // apunto primero al registro del modelo y con el get traido el valor de lo que tengo en el name de la plantilla blade.
        $student->nombres=$request->get('nombres');
        $student->apellido_paterno = $request->get('apellido_paterno');
        $student->apellido_materno = $request->get('apellido_materno');
        $student->carrera = $request->get('carrera');
        $student->grado = $request->get('grado');
        $student->grupo = $request->get('grupo');
        $student->turno = $request->get('turno');
        $student->save(); //guardo el registro
        return redirect('/students'); //retorno a la vista enrutada. 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $student = Student::find($id); //encuentro el registro
        $student->delete(); //lo elimino
        return redirect('/students'); //redirijo a la vista
    }
}
