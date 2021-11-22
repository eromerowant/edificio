@extends('layouts.app')

@section('content')
   <h1 class="h2 text-center">Listado de departamentos</h1>
   <div class="row">
      <div class="col-md-12">
         <div class="col-md-12">
            <table class="table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th>Número</th>
                     <th>Deuda Actual</th>
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
                        <td class="border {{ $dept->get_deuda_actual() >= 0 ? "bg-success" : "bg-danger" }}">
                           {{ number_format( $dept->get_deuda_actual(), 0, ',', '.' ) }}
                        </td>
                        <td>
                           <button type="button" class="btn btn-sm btn-info">Botón</button>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection
