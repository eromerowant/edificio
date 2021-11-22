@extends('layouts.app')

@section('content')
<h1>Listado de departamentos</h1>
   <ul>
      @foreach ($departamentos as $dept)
      <a href="{{ route('departamentos.show', ['dept_id' => $dept->id]) }}">
         <li>{{ $dept->numero }}</li>
      </a>
      @endforeach
   </ul>
@endsection
