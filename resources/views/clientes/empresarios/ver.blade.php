@extends('plantillas.formulario')

@section('cabecera')
    Empresario
@stop

@section ('formulario')
<div class="row">
<div class="col-xs-2"></div>
<div class="col-xs-8">
    <div class="dl-horizontal">
        <div class="form-group">
            <dt class="text-left">{{ Form::label('nombre', 'Nombre:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->nombre}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('sexo', 'Sexo:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->sexo}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('nit', 'NIT:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->nit}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('dui', 'DUI:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->dui}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('municipio_id', 'Municipio:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->municipio->municipio}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('direccion', 'Dirección:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->direccion}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('correo', 'Correo Eléctronico:', array('class' => 'control-label')) }}</dt>
               <dd><p>{{$empresario->correo}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('telefono', 'Teléfono:', array('class' => 'control-label')) }}</dt>
            
                <dd><p>{{$empresario->telefono}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('celular', 'Celular:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->celular}}</p></dd>
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
        <a href="{{ route('editarEmpresario', array($empresario->id)) }}" tabindex="11" class="btn btn-primary">
        <span class="glyphicon glyphicon-pencil"> </span>
         Modificar
        </a>
        </center>

    </div>

</div>

@stop