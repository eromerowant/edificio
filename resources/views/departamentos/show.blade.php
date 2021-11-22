@extends('layouts.app')

@section('content')
    <h1 class="h2 text-center">Departamento N° <b>{{ $departamento->numero }}</b></h1>
    <p class="h4 text-center {{ $departamento->get_deuda_actual() >= '0' ? 'text-success' : 'text-danger' }}">Deuda Actual: {{ $departamento->get_deuda_actual() }}</p>
    <div class="row my-3">
        <div class="col-md-12">
            @include('messages-includes.includes')
        </div>
    </div>
    @if (count($departamento->movimientos) > 0)
        <div class="row">
            <div class="col-md-12">
                <h1 class="h3 text-center"><b>Movimientos</b></h1>
            </div>
            <div class="col-md-12">
                <table id="tabla_de_movimientos" class="table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-muted">ID</th>
                            <th class="text-muted">Código</th>
                            <th class="text-muted">Monto</th>
                            <th class="text-muted">Tipo</th>
                            <th class="text-muted">Status</th>
                            <th class="text-muted">Fecha de Confirmación</th>
                            <th class="text-muted">Fecha de Registro</th>
                            <th class="no_exportar">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- DATATABLE SERVER SIDE PROCESSING WITH YAJRA --}}
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p>No tiene Movimientos registrados aún</p>
    @endif
    


    <div class="row my-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h4 text-center"><b>Registrar Nuevo Movimiento</b></h2>
                        </div>
                    </div>
                    <form action="{{ route('movimientos.store', ['dept_id' => $departamento->id]) }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group-group mb-3">
                                    <label>Monto: </label>
                                    <input type="number" min="10" step="0.5" name="monto" class="form-control"
                                        placeholder="3500">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipo de movimiento:</label>
                                    <select name="tipo" class="form-control">
                                        <option value="" disabled>-- Seleccione --</option>
                                        <option value="1">Deuda</option>
                                        <option value="2">Pago</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-group mb-3">
                                    <label>Código: (Opcional) </label>
                                    <input type="text" name="codigo_identificador" class="form-control"
                                        placeholder="Ejemplo: xy6Hus7">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-group mb-3">
                                    <label>Fecha de Registro (Opcional) </label>
                                    <input type="date" name="created_at" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status: (Opcional)</label>
                                    <select name="status" class="form-control">
                                        <option value="" disabled>-- Seleccione --</option>
                                        <option value="1">Confirmado</option>
                                        <option value="2" selected>Por Confirmar</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-group mb-3">
                                    <label>Fecha de Confirmación (Opcional) </label>
                                    <input type="date" name="fecha_de_confirmacion" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-group mb-3">
                                    <input class="btn btn-success" type="submit" value="Registrar Movimiento">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        var TABLA_MOVIMIENTOS;
        const RUTA_PARA_ELIMINAR_MOVIMIENTO= "{{ route('movimientos.delete') }}";

        $(document).ready(function() {

            TABLA_MOVIMIENTOS = $('#tabla_de_movimientos').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get_movimientos', ['departamento_id' => $departamento->id]) }}"
                },
                columns: [{
                        data: "id",
                        name: 'id'
                    },
                    {
                        data: "codigo",
                        name: 'codigo'
                    },
                    {
                        data: "monto",
                        name: 'monto',
                        render: function (data, type, row){
                            if ( data.tipo == "Pago" ) {
                                return `<span class="text-success">${data.monto}</span>`;
                            } else if( data.tipo == "Deuda" ) {
                                return `<span class="text-danger">${data.monto}</span>`;
                            }
                        },
                    },
                    {
                        data: "tipo",
                        name: 'tipo',
                        render: function (data, type, row){
                            if ( data === "Pago" ) {
                                return `<span class="text-success">${data}</span>`;
                            } else if( data === "Deuda" ) {
                                return `<span class="text-danger">${data}</span>`;
                            }
                        },
                    },
                    {
                        data: "status",
                        name: 'status'
                    },
                    {
                        data: "fecha_de_confirmacion",
                        name: 'fecha_de_confirmacion'
                    },
                    {
                        data: "fecha_de_registro",
                        name: 'fecha_de_registro'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row){
                            return `<button onclick="sweetAlertEliminarMovimiento('eliminar_movimiento_${data}', ${data})" type="button" class="btn btn-sm btn-danger">Eliminar</button><form action="${RUTA_PARA_ELIMINAR_MOVIMIENTO}" method="POST"> @csrf @method('delete')<input type="hidden" name="movimiento_id" value="${data}"><input id="eliminar_movimiento_${data}" class="d-none" type="submit" value="Eliminar Movimiento"></form>`;
                        },
                    }
                ],
                pageLength: 30,
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": '<i class="fas fa-greater-than"></i>',
                        "sPrevious": '<i class="fas fa-less-than"></i>'
                    },
                    oAria: {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    // url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: "Listado de Departamentos - " + new Date().toLocaleString(),
                    className: "bg-info",
                    exportOptions: {
                        columns: ':not(.no_exportar)'
                    }
                }],
            });

        });


        function sweetAlertEliminarMovimiento(div, numero) {
            Swal.fire({
                icon: "warning",
                title: `¿Deseas ELIMINAR este movimiento con id ${numero}?`,
                confirmButtonText: `Eliminar`,
                confirmButtonColor: '#d9534f',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById(div).click();
                }
            })
        }
    </script>
@endsection
