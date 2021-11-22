@extends('layouts.app')

@section('content')
    <h1 class="h2 text-center">Movimiento ID <b>{{ $movimiento->id }}</b></h1>
    <p class="h6 text-center">Departamento N° <b>{{ $movimiento->departamento->numero }}</b></p>
    <div class="row my-3">
        <div class="col-md-12">
            @include('messages-includes.includes')
        </div>
    </div>
  


    <div class="row my-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h4 text-center"><b>Detalle</b></h2>
                        </div>
                    </div>
                     <div class="row">

                           <div class="col-md-6">
                              <div class="form-group-group mb-3">
                                 <label>Monto: </label>
                                 <input disabled value="{{ $movimiento->monto }}" class="form-control">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Tipo de movimiento:</label>
                                 <input disabled value="{{ $movimiento->tipo == 1 ? "Deuda" : "Pago" }}" class="form-control">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group-group mb-3">
                                 <label>Código: (Opcional) </label>
                                 <input disabled value="{{ $movimiento->codigo_identificador }}" class="form-control">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group-group mb-3">
                                 <label>Fecha de Registro (Opcional) </label>
                                 <input disabled value="{{ $movimiento->created_at->format('d/m/Y') }}" class="form-control">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Status: (Opcional)</label>
                                 <input disabled value="{{ $movimiento->status == 1 ? "Confirmado" : "Por Confirmar" }}" class="form-control">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group-group mb-3">
                                 <label>Fecha de Confirmación (Opcional) </label>
                                 <input disabled value="{{ $movimiento->fecha_de_confirmacion ? $movimiento->fecha_de_confirmacion->format('d/m/Y') : null }}" class="form-control">
                              </div>
                           </div>

                           @if ( $movimiento->status == 1 )
                              <div class="col-md-6">
                                 <div class="form-group-group mb-3">
                                    <form action="{{ route('movimientos.cambiar_status', ['movimiento_id' => $movimiento->id]) }}" method="POST">
                                       @csrf
                                       <input class="btn btn-danger" type="submit" value="Quitar Confirmación">
                                    </form>
                                 </div>
                              </div>
                           @else
                              <div class="col-md-6">
                                 <div class="form-group-group mb-3">
                                    <form action="{{ route('movimientos.cambiar_status', ['movimiento_id' => $movimiento->id]) }}" method="POST">
                                       @csrf
                                       <input class="btn btn-success" type="submit" value="Confirmar movimiento">
                                    </form>
                                 </div>
                              </div>
                           @endif

                     </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection

