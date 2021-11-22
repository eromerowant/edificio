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
            <table class="table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th>Número</th>
                     <th>Deuda Actual</th>
                     <th>Cantidad de Movimientos</th>
                     <th>Acciones</th>
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