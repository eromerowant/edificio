@extends('layouts.app')

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
            <table id="departamentos" class="table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-muted">Numero</th>
                        <th class="text-muted">Deuda Actual</th>
                        <th class="text-muted">Cantidad de Movimientos</th>
                        <th class="no_exportar">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $departamentos as $dept )
                    <tr>
                       <td>
                          <a href="{{ route('departamentos.show', ['dept_id' => $dept->id]) }}">
                             {{ $dept->numero }}
                          </a>
                       </td>
                       <td>
                          <a class="{{ $dept->get_deuda_actual() >= 0 ? "text-success" : "text-danger" }}" href="{{ route('departamentos.show', ['dept_id' => $dept->id]) }}">
                             {{ number_format( $dept->get_deuda_actual(), 0, ',', '.' ) }}
                          </a>
                       </td>
                       <td>
                          {{ count($dept->movimientos) }}
                       </td>
                       <td>
                          <button onclick="sweetAlert(`eliminar_departamento_{{ $dept->id }}`, {{ $dept->numero }})" type="button" class="btn btn-sm btn-danger">Eliminar</button>
                          
                          <form action="{{ route('departamentos.delete', ['dept_id' => $dept->id]) }}" method="POST">
                             @csrf
                             @method('delete')
                             <input id="eliminar_departamento_{{ $dept->id }}" class="d-none" type="submit" value="Eliminar Departamento">
                          </form>
                       </td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
         </div>
      </div>
   </div>

  
@endsection

@section('custom_js')
    <script>
        var TABLE;

        $(document).ready(function() {

            // DataTables initialisation
            TABLE = $('#departamentos').DataTable({
                pageLength: 10,
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
                    title: "Listado de departamentos - " + new Date().toLocaleString(),
                    className: "bg-info",
                    exportOptions: {
                        columns: ':not(.no_exportar)'
                    }
                }],

            });

        });


        function sweetAlert(div, numero) {
            Swal.fire({
                icon: "warning",
                title: `¿Deseas ELIMINAR el departamento N° ${numero}?`,
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