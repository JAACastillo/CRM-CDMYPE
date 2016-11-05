@extends('plantillas.formulario')

@section('cabecera')
    Empresario
@stop

@section ('formulario')

{{ Form::model($empresario, array('route' => array('actualizarEmpresario', $empresario->id), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) }}
@include('errores', array('errors' => $errors))

@include('clientes/empresarios/form')

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <br/>
                        <center>
                        <a href="javascript:history.back()">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                         Cancelar
                        </a>
                        </center>
                    </div>
                    <div class="col-xs-6">
                        <br/>
                        <center>
                        <button type="submit"class="btn btn-primary ladda-button" data-style="expand-right">
                        <span class="glyphicon glyphicon-floppy-disk">&nbsp</span>
                         Guardar
                        </span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                        </button>
                        </center>
                    </div>
                </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop