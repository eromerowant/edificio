@extends('layouts.app')

@section('custom_css')
    <style>
        #tabla_de_departamentos_filter {
            display: none;
        }

        /* .dt-buttons {
                display: none;
            } */

    </style>
@stop

@section('content')
    <h1 class="h2 text-center">Listado de Departamentos</h1>
    <div class="row my-3">
        <div class="col-md-12">
            @include('messages-includes.includes')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <table id="tabla_de_departamentos" class="table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-muted">ID</th>
                            <th class="text-muted">Dept</th>
                            <th class="text-muted">Deuda Actual</th>
                            <th class="text-muted">Cantidad de Movimientos</th>
                            <th class="no_exportar">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- DATATABLE SERVER SIDE PROCESSING WITH YAJRA --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('custom_js')
    <script>
        var TABLA_DEPARTAMENTOS;

        $(document).ready(function() {

            TABLA_DEPARTAMENTOS = $('#tabla_de_departamentos').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get_departamentos') }}"
                },
                columns: [{
                        data: "id",
                        name: 'id'
                    },
                    {
                        data: "numero",
                        name: 'numero'
                    },
                    {
                        data: "deuda_actual",
                        name: 'deuda_actual',
                        render: function (data, type, row){
                            if ( data >= "0" ) {
                                return `<span class="text-success">${data}</span>`;
                            } else {
                                return `<span class="text-danger">${data}</span>`;
                            }
                        },
                    },
                    {
                        data: "cantidad_de_movimientos",
                        name: 'cantidad_de_movimientos'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
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
    </script>
@endsection
