@extends('layouts.master')
@section('titulo', 'GRUPOS')
@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
        border: 2px solid #000;
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

    .confirmation-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .confirmation-modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        text-align: center;
        padding: 20px;
        width: 300px;
    }

    .confirmation-buttons button {
        margin: 0 10px;
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .confirmation-buttons button:hover {
        opacity: 0.8;
    }

    #confirmButton {
        background-color: #3085d6;
        color: white;
    }

    #cancelButton {
        background-color: #aaa;
        color: #fff;
    }

    .page-link-black-bold {
        font-family: 'Arial';
        color: black;
        font-weight: bold;
    }

    .page-link-prev-next {
        font-family: 'Arial';
        color: black;
        font-weight: bold;
    }

    .page-link-default {
        font-family: 'Arial';
        color: #007bff;
        /* Azul predeterminado */
    }
</style>

<div class="card mt-4">
    <div class="card-body">
        <!-- Encabezado de la sección -->
        <h5 class="card-body text-center shadow-effect">CREAR GRUPOS</h5>

        <!-- Contenedor de botones para agregar grupo y navegar a subgrupos -->
        <div class="button-container d-flex justify-content-between align-items-center pr-4 mt-2">
            <!-- Botón para abrir el modal para agregar un nuevo grupo -->
            <a href="#" id="agregar-btn" class="btn btn-warning font-weight-bold " data-toggle="modal" data-target="#modalGrupo">
                <i class="fas fa-plus"></i> Agregar Grupo
            </a>
            <!-- Botón para ir a la lista de subgrupos -->
            <a href="/grupos_subgrupos" class="btn btn-warning font-weight-bold">
                Ir a subgrupos <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Tabla para mostrar la lista de grupos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered custom-table">
                <!-- Encabezados de la tabla -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CLAVE</th>
                        <th>CONCEPTO</th>
                        <th class="opciones">ACCIONES</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
                <tbody>
                    <!-- Bucle para mostrar cada grupo -->
                    @foreach($cgrupos as $row)
                    <tr>
                        <td class="align-middle text-center">{{$row->id}}</td>
                        <td class="align-middle text-center">{{$row->clave}}</td>
                        <td class="align-middle text-center">{{$row->concepto}}</td>
                        <td>
                            <!-- Botones para editar y eliminar cada grupo -->
                            <div class="d-inline-flex mt-2">
                                <a href="#" class="btn btn-primary mb-2 mx-2 edit-btn" data-url="{{ url('/nuevogrupo') }}/{{$row->id}}" onclick="return showEditConfirmation(this)"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{url('/nuevogrupo',[$row])}}" method="post" style="display: inline-block;">
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

        <!-- Modal para agregar un nuevo grupo -->
        <div class="modal fade" id="modalGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bdecb6;">
                        <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Formulario para agregar un nuevo grupo -->
                    <form action="{{url('/nuevogrupo')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <!-- Campos para ingresar datos del nuevo grupo -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="clave" placeholder="Clave del grupo">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="concepto" placeholder="Descripción del grupo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Botones para cancelar y guardar el nuevo grupo -->
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Paginación -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        {{-- Botón Anterior --}}
        @if ($cgrupos->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link page-link-black">Anterior</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link page-link-prev-next" href="{{ $cgrupos->previousPageUrl() }}" tabindex="-1">Anterior</a>
        </li>
        @endif

        {{-- Números de Página --}}
        @if ($cgrupos->lastPage() > 1)
        @for ($i = max(1, $cgrupos->currentPage() - 1); $i <= min($cgrupos->lastPage(), $cgrupos->currentPage() + 1); $i++)
            <li class="page-item {{ $i == $cgrupos->currentPage() ? 'active' : '' }}">
                <a class="page-link {{ $i == $cgrupos->currentPage() ? 'page-link-black-bold' : 'page-link-default' }}" href="{{ $cgrupos->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            @endif

            {{-- Botón Siguiente --}}
            @if ($cgrupos->hasMorePages())
            <li class="page-item">
                <a class="page-link page-link-prev-next" href="{{ $cgrupos->nextPageUrl() }}" tabindex="-1">Siguiente</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link page-link-black">Siguiente</span>
            </li>
            @endif
    </ul>
</nav>


<!-- Modal para la confirmación de eliminación -->
<div id="confirmationModal" class="confirmation-modal">
    <div class="confirmation-modal-content">
        <p>¿Estás seguro de que deseas eliminar este registro?</p>
        <div class="confirmation-buttons">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" id="confirmButton">Confirmar</button>
            </form>

            <button id="cancelButton" onclick="hideConfirmationModal()">Cancelar</button>
        </div>
    </div>
</div>



<script>

    //todo: mensaje de eliminación
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


    //todo: Función para mostrar la alerta de confirmación al hacer clic en el botón de editar

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

    //todo: ALERTA DESPUES DE AGREGAR UN REGISTRO

    document.addEventListener('DOMContentLoaded', function() {
        // Escucha el evento submit del formulario
        document.querySelector('#modalGrupo form').addEventListener('submit', function(event) {
            event.preventDefault(); // Previene el comportamiento predeterminado del formulario

            // Captura una referencia al modal
            let modal = document.querySelector('#modalGrupo');

            // Envía la solicitud AJAX para guardar el nuevo grupo
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
                            // Redirige a la vista nuevogrupo después de mostrar el mensaje
                            window.location.href = '{{ url('/nuevogrupo') }}';
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

    //todo: MENSAJE DE EDICIÓN

    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si existe un mensaje de éxito en la sesión flash
        var successMessage = '{{ session('success_message') }}'; // Asegúrate de que esté correctamente definida como una variable JavaScript
        if (successMessage) {
            // Mostrar el mensaje de éxito con SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: successMessage
            });
        }
    });

    // Agregar evento submit al formulario de edición
    document.querySelector('#editForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

        // Capturar una referencia al modal
        let modal = document.querySelector('#modalGrupo');

        // Envía la solicitud AJAX para actualizar el grupo
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
                    // Redirige a la vista nuevogrupo después de mostrar el mensaje
                    window.location.href = '{{ url('/nuevogrupo') }}';
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

</script>


@endsection