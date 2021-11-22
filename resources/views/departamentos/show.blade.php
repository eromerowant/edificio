@extends('layouts.app')

@section('content')
   <h1 class="h2 text-center">Departamento N° <b>{{ $departamento->numero }}</b></h1>
   <div class="row my-3">
      <div class="col-md-12">
         @include('messages-includes.includes')
      </div>
   </div>
   @if ( count($departamento->movimientos) > 0 )
      <div class="row">
         <div class="col-md-12">
            <h1 class="h3 text-center"><b>Movimientos</b></h1>
         </div>
         <div class="col-md-12">
            <table class="table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Código</th>
                     <th>Monto</th>
                     <th>Tipo</th>
                     <th>Status</th>
                     <th>Fecha de Confirmación</th>
                     <th>Fecha de Registro</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ( $departamento->movimientos as $movimiento )
                     <tr>
                        <td>{{ $movimiento->id }}</td>
                        <td>{{ $movimiento->codigo_identificador }}</td>
                        <td>{{ number_format( $movimiento->monto, 0, ',', '.' ) }}</td>
                        <td class="{{ $movimiento->tipo === 1 ? "text-danger" : "text-success" }}">
                           {{ $movimiento->tipo == 1 ? "Deuda" : "Pago" }}
                        </td>
                        <td>{{ $movimiento->status == 1 ? "Confirmado" : "Por Confirmar" }}</td>
                        <td>{{ $movimiento->fecha_de_confirmacion ? $movimiento->fecha_de_confirmacion->format('d-m-Y') : "-" }}</td>
                        <td>{{ $movimiento->created_at->format('d-m-Y') }}</td>
                        <td>
                           <button type="button" class="btn btn-sm btn-info">Botón</button>
                           
                           <button onclick="sweetAlert(`eliminar_movimiento_{{ $movimiento->id }}`, {{ $movimiento->id }})" type="button" class="btn btn-sm btn-danger">Eliminar</button>

                           <form action="{{ route('movimientos.delete', ['movimiento_id' => $movimiento->id]) }}" method="POST">
                              @csrf
                              @method('delete')
                              <input id="eliminar_movimiento_{{ $movimiento->id }}" class="d-none" type="submit" value="Eliminar Movimiento">
                           </form>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   @else
      <p>No tiene Movimientos registrados aún</p>
   @endif


   <div class="row my-5">
      <div class="col-md-12">
         <div class="card">
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
                           <input type="number" min="10" step="0.5" name="monto" class="form-control" placeholder="3500">
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
                           <input type="text" name="codigo_identificador" class="form-control" placeholder="Ejemplo: xy6Hus7">
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
        function sweetAlert(div, numero) {
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
