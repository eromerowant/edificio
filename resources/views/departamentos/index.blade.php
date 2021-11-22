@extends('layouts.app')

@section('content')
<h1>Listado de departamentos</h1>
   <ul>
      @foreach ($departamentos as $departamento)
         <li>{{ $departamento->numero }}</li>
      @endforeach
   </ul>
@endsection
