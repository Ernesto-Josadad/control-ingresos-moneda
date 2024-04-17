@extends('layouts.master')
@section('titulo', 'SUBGRUPOS')
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
        border: 2px solid #000;
    }

    .opciones {
        width: 120px;
    }

    .card {
        border-radius: 10px;

    }

    .shadow-effect {

        font-family: 'TIMES NEW ROMAN';
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
        <h5 class="card-body text-center shadow-effect">CREAR SUBGRUPOS</h5>

        <!-- Contenedor de botones para regresar y agregar subgrupos -->
        <div class="button-container d-flex justify-content-between align-items-center pr-4 mt-2">
            <!-- Botón para regresar a la lista de grupos -->
            <a href="/nuevogrupo" class="btn btn-warning font-weight-bold">
                <i class="fas fa-arrow-left"></i> Regresar a grupos
            </a>
            <!-- Botón para abrir el modal para agregar un nuevo subgrupo -->
            <a href="#" id="agregar-btn" class="btn btn-warning font-weight-bold " data-toggle="modal" data-target="#modalSubgrupo">
                <i class="fas fa-plus"></i> Agregar Subgrupo
            </a>
        </div>

        <!-- Tabla para mostrar la lista de subgrupos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered custom-table">
                <!-- Encabezados de la tabla -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="opciones">GRUPO</th>
                        <th>CODIGO SUBGRUPO</th>
                        <th>DESCRIPCIÓN</th>
                        <th class="opciones">COSTO</th>
                        <th class="opciones">ACCIONES</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
                <tbody>
                    <!-- Bucle para mostrar cada subgrupo -->
                    @foreach($csubgrupos as $row)
                    <tr>
                        <td class="align-middle text-center">{{$row->id}}</td>
                        <td class="align-middle text-center">
                            @php
                            $grupo = App\Models\Grupos::find($row->clave_grupo_id);
                            @endphp
                            @if ($grupo)
                            {{$grupo->clave}}
                            @endif
                        </td>

                        <td class="align-middle text-center">{{$row->codigo}}</td>
                        <td class="align-middle text-center">{{$row->descripcion}}</td>
                        <td class="align-middle text-center">${{$row->costo}}</td>
                        <td>
                            <!-- Botones para editar y eliminar cada subgrupo -->
                            <div class="d-inline-flex mt-2">
                                <a href="#" class="btn btn-primary mb-2 mx-2 edit-btn" data-url="{{ url('/grupos_subgrupos') }}/{{$row->id}}" onclick="return showEditConfirmation(this)"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{url('/grupos_subgrupos',[$row])}}" method="post" style="display: inline-block;">
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

        <!-- Modal para agregar un nuevo subgrupo -->
        <div class="modal fade" id="modalSubgrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bdecb6;">
                        <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Subgrupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Formulario para agregar un nuevo subgrupo -->
                    <form action="{{url('/grupos_subgrupos')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <!-- Campos para ingresar datos del nuevo subgrupo -->
                            <div class="form-group">
                                <select class="form-control" name="clave_grupo_id">
                                    <option value="">Selecciona un grupo</option>
                                    @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->clave}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="codigo" placeholder="Codigo del subgrupo" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="descripcion" placeholder="Descripción del subgrupo" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="costo" placeholder="Costo del subgrupo" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Botones para cancelar y guardar el nuevo subgrupo -->
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
        @if ( $csubgrupos->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link page-link-black">Anterior</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link page-link-prev-next" href="{{  $csubgrupos->previousPageUrl() }}" tabindex="-1">Anterior</a>
        </li>
        @endif

        {{-- Números de Página --}}
        @if ( $csubgrupos->lastPage() > 1)
        @for ($i = max(1,  $csubgrupos->currentPage() - 1); $i <= min( $csubgrupos->lastPage(),  $csubgrupos->currentPage() + 1); $i++)
            <li class="page-item {{ $i ==  $csubgrupos->currentPage() ? 'active' : '' }}">
                <a class="page-link {{ $i ==  $csubgrupos->currentPage() ? 'page-link-black-bold' : 'page-link-default' }}" href="{{  $csubgrupos->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            @endif

            {{-- Botón Siguiente --}}
            @if ( $csubgrupos->hasMorePages())
            <li class="page-item">
                <a class="page-link page-link-prev-next" href="{{  $csubgrupos->nextPageUrl() }}" tabindex="-1">Siguiente</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link page-link-black">Siguiente</span>
            </li>
            @endif
    </ul>
</nav>

<!-- Incluir Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
//todo MENSAJE DE ELIMINACIÓN
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


    // TODO Función para mostrar la alerta de confirmación al hacer clic en el botón de editar
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

    //TODO MENSAJE DE AGREGADO DE SUBGRUPO

    document.addEventListener('DOMContentLoaded', function() {
        // Escucha el evento submit del formulario
        document.querySelector('#modalSubgrupo form').addEventListener('submit', function(event) {
            event.preventDefault(); // Previene el comportamiento predeterminado del formulario

            // Captura una referencia al modal
            let modal = document.querySelector('#modalSubgrupo');

            // Envía la solicitud AJAX para guardar el nuevo subgrupo
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
                            // Redirige a la vista grupos_subgrupos después de mostrar el mensaje
                            window.location.href = '{{ url('/grupos_subgrupos') }}';
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

    //TODO MENSAJE DE EDICIÓN

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
        let modal = document.querySelector('#modalSubgrupo');

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
                    window.location.href = '{{ url('/grupos_subgrupos') }}';
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