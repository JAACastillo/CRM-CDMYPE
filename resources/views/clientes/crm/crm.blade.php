@extends('menu')

@section('escritorio')

<style type="text/css">
   body{
      background-color: #C5C7BC;
   }
   h2, h3{
      margin: 0px;
   }
   .nota{
      font-size: 12px;
   }
   .page-header{
      margin: 0px 0px 10px 0px;
   }
   .caret{
      font-size: 28px;
   }
   #lb_seguimiento{
      font-size: 12px;
      color: white;
      background-color: gray;
      border-radius: 5px;
      margin: -35px 0px ;
      border: 8px solid gray;
   }
   .panel{
      margin-bottom: -30px 0px 0px 0px;
   }
   .agregar{
      font-size: 12px;
      margin: 0px 15px 5px 15px;
   }
   .l-agregar{
      font-size: 12px;
      margin: -5px 15px 5px 0px;
   }
   .form-group{
      margin: 0px;
   }
   hr{
      margin: 10px;
   }
</style>

<div class="row">
   <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
         <div class="panel-body">
            @include('clientes.crm.detalleEmpresa')
            <br>
            @include('clientes.crm.detalleCliente')
            <hr>
            @include('clientes.crm.lista')
         </div>
      </div>
</div>

@stop
