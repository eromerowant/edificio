@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="row my-3">
         <h1 class="h2">Crear Nuevo Departamento</h1>
      </div>

      <div class="row">
         <div class="col-md-12">
            @include('messages-includes.includes')
         </div>
      </div>
      
      <div class="row">

         <form action="{{ route('departamentos.store') }}" method="POST">
            @csrf

            <div class="input-group mb-3">
               <input type="number" min="1" step="1" name="numero" class="form-control">
             </div>

             <div class="input-group mb-3">
               <input type="submit" class="btn btn-success" value="Registrar Nuevo Departamento">
             </div>

         </form>
      </div>
   </div>


@endsection
