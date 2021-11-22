@extends('layouts.app')

@section('content')
<h1>Departamento N° <b>{{ $departamento->numero }}</b></h1>
   <ul>
      @foreach ($movimientos as $movimiento)
         <li>{{ $movimiento->monto }} - {{ $movimiento->tipo }} - {{ $movimiento->fecha }}</li>
      @endforeach
   </ul>
@endsection
