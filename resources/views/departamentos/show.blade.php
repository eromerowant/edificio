@extends('layouts.app')

@section('content')
   <h1 class="h2 text-center">Departamento N° <b>{{ $departamento->numero }}</b></h1>
   @if ( count($departamento->movimientos) > 0 )
      <div class="row">
         <div class="col-md-12">
            <h1 class="h3 text-center"><b>Movimientos</b></h1>
         </div>
         <div class="col-md-12">
            <table class="table-hover" style="width:100%">
               <thead>
                  <tr>
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
                        <td>{{ $movimiento->codigo_identificador }}</td>
                        <td>{{ number_format( $movimiento->monto, 0, ',', '.' ) }}</td>
                        <td class="{{ $movimiento->tipo === 1 ? "bg-danger" : "bg-success" }}">
                           {{ $movimiento->tipo === 1 ? "Deuda" : "Pago" }}
                        </td>
                        <td>{{ $movimiento->status === 1 ? "Confirmado" : "Por Confirmar" }}</td>
                        <td>{{ $movimiento->fecha_de_confirmacion->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $movimiento->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                           <button type="button" class="btn btn-sm btn-info">Botón</button>
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

@endsection
