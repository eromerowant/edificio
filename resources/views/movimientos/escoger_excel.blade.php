@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <h1 class="h3 text-center">Sube un excel con los gastos comunes como se refleja a continuación:</h1>
         </div>
         <div class="col-md-12">
            <table class="table">
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>10.000</td>
                     <td>22-11-2021</td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td>20.000</td>
                     <td>22-11-2021</td>
                  </tr>
                  <tr>
                     <td>3</td>
                     <td>30.000</td>
                     <td>22-11-2021</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-md-12">
            <p>La primera fila es el numero de departamento</p>
            <p>La segunda fila es el monto en pesos</p>
            <p>La tercera fila es la fecha en formato d-m-Y</p>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <form action="{{ route('movimientos.subir_excel_con_gastos_comunes') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <input name="file" type="file" class="form-control">
                  <input type="submit" class="btn btn-success">
               </div>
            </form>
         </div>
      </div>
   </div>

@endsection

