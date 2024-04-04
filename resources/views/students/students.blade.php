@extends('layouts.master')
@section('titulo', 'ALUMNOS')
@section('contenido')
<style>
    .button-container {
        margin-left: 2%;
    }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th,
    .custom-table td {
        border: 5px solid #000;
        padding: 5px;
        font-family: 'Arial Narrow';
        text-align: center;
    }

    .custom-table th {
        /* background-color: #bdecb6; */
        background-color: #00FF7F;
        font-family: 'Courier New';
        text-align: center;
    }

    .custom-table.table-bordered th,
    .custom-table.table-bordered td {
        border: 1px solid #000;
    }

    .opciones {
        width: 150px;
    }

    .card {
        border-radius: 10px;

    }

    .shadow-effect {
        font-family: 'TIMES NEW ROMAN';
    }

    .page-link-black {
        font-family: 'arial';
        color: black;
        font-weight: bold;
    }
</style>


<div class="card mt-4">
    <div class="card-body">
        <!-- Encabezado de la sección -->
        <h5 class="card-body text-center shadow-effect">ALUMNOS</h5>

        <!-- Barra de búsqueda -->
        <div class="barra">
            <form id="searchForm" action="{{ route('students.index') }}" method="GET" class="input-group">
                <input id="searchInput" name="search" class="form-control search-input" type="search" placeholder="Buscar..." value="{{ $search ?? '' }}" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-top-left-radius: 10px; border-bottom-left-radius: 10px; border: 1px solid #000000; background-color: #FFFACD;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border: 1px solid #000000;"><i class="fas fa-search"></i></button>
                </div>
                @if($search)
                <button type="button" class="btn btn-secondary ml-2" onclick="clearSearch()" style="background-color: #98FB98; color: black; font-weight: bold; border: 1px solid #008000; border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Limpiar búsqueda</button>
                @endif
            </form>
        </div>


        <br>
        <div style="margin-left: 84%;">
            <button type="button" class="btn btn-warning font-weight-bold shadow-sm" shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-regular fa-square-plus"></i> Nuevo Alumno
            </button>
        </div>

        <!-- Tabla para mostrar la lista de grupos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered custom-table">
                <!-- Encabezados de la tabla -->
                <thead>
                    <tr>
                        <th class="tabla-header align-middle text-center">#</th>
                        <th class="tabla-header align-middle text-center">MATRICULA</th>
                        <th class="tabla-header align-middle text-center">NOMBRES</th>
                        <th class="tabla-header align-middle text-center">APELLIDO PATERNO</th>
                        <th class="tabla-header align-middle text-center">APELLIDO MATERNO</th>
                        <th class="tabla-header align-middle text-center">GRADO</th>
                        <th class="tabla-header align-middle text-center">GRUPO</th>
                        <th class="tabla-header align-middle text-center">CARRERA</th>
                        <th class="tabla-header align-middle text-center">TURNO</th>
                        <th class="tabla-header align-middle text-center">ACCIONES</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
                <tbody>
                    <!-- Bucle para mostrar cada grupo -->
                    @foreach($students as $row)
                    <!-- la primera variable es la que mande en el compat
            despues del as es el valor que se va a sustituir en la tabla -->
                    <td class="tabla-header align-middle text-center">{{$row -> id}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> matricula}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> nombres}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> apellido_paterno}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> apellido_materno}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> grado}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> grupo}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> carrera}}</td>
                    <td class="tabla-header align-middle text-center">{{$row -> turno}}</td>
                    <td>
                    <div class="d-inline-flex mt-2">
                            <a href="#" class="btn btn-primary mb-2 mx-2 edit-btn" data-url="{{ url('/students') }}/{{$row->id}}" onclick="return showEditConfirmation(this)"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{url('/students',[$row])}}" method="post" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger mx-2 delete-btn"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bdecb6;">
                        <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Alumno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/students')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="Matricula" class="form-control mt-2" name="matricula">
                                <input type="text" placeholder="Nombre" class="form-control mt-2" name="nombres">
                                <input type="text" placeholder="Apellido Paterno" class="form-control mt-2" name="apellido_paterno">
                                <input type="text" placeholder="Apellido Materno" class="form-control mt-2" name="apellido_materno">
                                <input type="text" placeholder="Grado" class="form-control mt-2" name="grado">
                                <input type="text" placeholder="Grupo" class="form-control mt-2" name="grupo">
                                <input type="text" placeholder="Carrera" class="form-control mt-2" name="carrera">
                                <input type="text" placeholder="Turno" class="form-control mt-2" name="turno">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-outline-success">GUARDAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Paginación -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        {{-- Botón Anterior --}}
        @if ($students->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link page-link-black">Anterior</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link page-link-black" href="{{ $students->previousPageUrl() }}" tabindex="-1">Anterior</a>
        </li>
        @endif

        {{-- Números de Página --}}
        @if ($students->lastPage() > 1)
        @for ($i = max(1, $students->currentPage() - 1); $i <= min($students->lastPage(), $students->currentPage() + 1); $i++)
            <li class="page-item {{ $i == $students->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $students->appends(['search' => $search])->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            @endif

            {{-- Botón Siguiente --}}
            @if ($students->hasMorePages())
            <li class="page-item">
                <a class="page-link page-link-black" href="{{ $students->nextPageUrl() }}" tabindex="-1">Siguiente</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link page-link-black">Siguiente</span>
            </li>
            @endif
    </ul>
</nav>

<!-- End Paginación -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function clearSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchForm').submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Función para mostrar u ocultar el botón de limpiar búsqueda
        function toggleClearButton() {
            var searchInput = document.getElementById('searchInput');
            var clearButton = document.getElementById('clearButton');

            if (searchInput.value === '') {
                clearButton.style.display = 'none';
            } else {
                clearButton.style.display = 'inline-block';
            }
        }

        // Ejecutar la función toggleClearButton al cargar la página
        toggleClearButton();

        // Agregar evento oninput al input de búsqueda
        document.getElementById('searchInput').addEventListener('input', function() {
            toggleClearButton();
        });
    });


// Agregar evento click al botón de eliminar para mostrar Sweet Alert de confirmación
const deleteButtons = document.querySelectorAll('.delete-btn');
deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Una vez eliminado, no podrás recuperar este registro.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener el formulario de eliminación asociado al botón
                const form = button.closest('form');

                // Enviar el formulario de eliminación
                fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (response.ok) {
                        // Si se elimina correctamente, mostrar mensaje de éxito
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: 'El registro ha sido eliminado correctamente.',
                            icon: 'success',
                            showConfirmButton: true, // Mostrar el botón "Ok"
                            allowOutsideClick: false // Evitar que el usuario cierre el mensaje haciendo clic fuera
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Opcional: recargar la página después de un tiempo para reflejar los cambios
                                window.location.reload();
                            }
                        });
                    } else {
                        // Si hay un error en la eliminación, mostrar mensaje de error
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar el registro. Por favor, inténtalo de nuevo.',
                            'error'
                        );
                    }
                }).catch(error => {
                    console.error('Error al enviar la solicitud:', error);
                    // Mostrar mensaje de error si falla la eliminación
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar el registro. Por favor, inténtalo de nuevo.',
                        'error'
                    );
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Mostrar mensaje de cancelación si el usuario cancela
                Swal.fire(
                    'Cancelado',
                    'La eliminación ha sido cancelada.',
                    'info'
                );
            }
        });
    });
});


    // Función para mostrar la alerta de confirmación al hacer clic en el botón de editar
    function showEditConfirmation(button) {
        var url = button.getAttribute('data-url');

        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres editar este registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma, redirigir a la página de edición
                window.location.href = url;
            } else {
                // Mostrar mensaje de cancelación
                Swal.fire(
                    'Cancelado',
                    'La edición ha sido cancelada.',
                    'info'
                );
            }
        });
        // Prevenir el comportamiento predeterminado del enlace
        return false;
    }

    //mensaje de agregado del agregado de alumnos

    document.addEventListener('DOMContentLoaded', function () {
    // Escucha el evento submit del formulario
    document.querySelector('#exampleModal form').addEventListener('submit', function (event) {
        event.preventDefault(); // Previene el comportamiento predeterminado del formulario

        // Captura una referencia al modal
        let modal = document.querySelector('#exampleModal');

        // Envía la solicitud AJAX para guardar el nuevo alumno
        fetch(this.action, {
            method: this.method,
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Cierra el modal independientemente de si la respuesta es exitosa o no
            $(modal).modal('hide');

            // Si la respuesta indica éxito, muestra el mensaje de éxito
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.message
                }).then((result) => {
                    // Redirige a la vista students después de mostrar el mensaje
                    window.location.href = '{{ url('/students') }}';
                });
            } else {
                // Si la respuesta indica un error, muestra un mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al guardar el grupo. Por favor, inténtalo de nuevo.'
                });
            }
        })
        .catch(error => {
            console.error('Error al enviar la solicitud:', error);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
        // Verificar si existe un mensaje de éxito en la sesión flash
        let successMessage = '{{ session('success_message') }}';
        if (successMessage) {
            // Mostrar el mensaje de éxito con SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: successMessage
            });
        }
    });
</script>

@endsection