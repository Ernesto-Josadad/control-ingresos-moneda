document.addEventListener('DOMContentLoaded', function() {
    // Aquí dentro colocarías todas tus funciones y llamadas a funciones
    actualizarCampos();
    
});

function actualizarCampos() {
    document.getElementById('btnActualizar').addEventListener('click', function() {
        var matriculaAlumno = document.getElementById('inputAlumno').value; // Obtener la matrícula del alumno
        var alumnos = @json($student);
        
        var alumnoSeleccionado = alumnos.find(function(alumno) {
            return alumno.matricula == matriculaAlumno; // Comparar por matrícula en lugar de ID
        });

        document.getElementById('nombres').value = alumnoSeleccionado.nombres;
        document.getElementById('matricula').value = alumnoSeleccionado.matricula;
        document.getElementById('apellido_paterno').value = alumnoSeleccionado.apellido_paterno;
        document.getElementById('grado').value = alumnoSeleccionado.grado;
        document.getElementById('grupo').value = alumnoSeleccionado.grupo;
        
    });
}


