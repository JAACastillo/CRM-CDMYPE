@extends('plantillas.formulario')

@section('cabecera')
    Empresa
@stop
@section('nombre')
    {{$empresa->nombre}}
@stop

@section ('formulario')
<div class="row">
<div class="col-xs-2"></div>
<div class="col-xs-8">
    <div class="dl-horizontal">
        <div class="form-group">
            <dt class="text-left">{{ Form::label('nombre', 'Nombre:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->nombre}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('categoria', 'Categoria:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->categoria}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('municipio', 'Municipio:', array('class' => 'control-label')) }}</dt>
                <dd><p> {{$empresa->municipio->municipio}} </p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('registro_iva', 'Registro de Iva:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->registro_iva}}<p/></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('constitucion', 'Constitución:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->constitucion}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('clasificacion', 'Clasificación:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->clasificacion}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('sector_economico', 'Sector Económico:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->sector_economico}}<p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('actividad', 'Actividad Económica:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->actividad}}<p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('descripcion', 'Descripcion:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->descripcion}}<p></dd>
        </div>
    </div>
</div>
<div class="col-xs-2"></div>
</div>
<div class="row">
    <div class="col-xs-6">
        <br/>
        <center>
        <a href="javascript:history.back()">
        <span class="glyphicon glyphicon-chevron-left"></span>
         Volver
        </a>
        </center>
    </div>
    <div class="col-xs-6">
        <br/>
        <center>
        <a href="{{ route('editarEmpresa', array($empresa->id)) }}" tabindex="11" class="btn btn-primary">
        <span class="glyphicon glyphicon-pencil"> </span>
         Modificar
        </a>
        </center>

    </div>

</div>

@stop