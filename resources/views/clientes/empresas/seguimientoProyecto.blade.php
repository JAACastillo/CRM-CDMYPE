@extends('menu')

@section('escritorio')

@include('clientes.empresas/pasos')

<div>
<br/>

@include('errores', array('errors' => $errors))
{{ Form::model($proyecto) }}


    {{Form::hidden('empresa_id', null)}}

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('nombre', 'Nombre de Proyecto:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{$proyecto->nombre}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('descripcion', 'Impacto:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                              <?php
                                $impactos = explode("\r\n", $proyecto->descripcion);
                                ?>
                                <ul>
                                    @foreach($impactos as $impacto)
                                            <li> 
                                                {{$impacto}}
                                            </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('fechaInicio', 'Fecha Inicio:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                               {{$proyecto->fechaInicio}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('fechaFin', 'Fecha Fin:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{$proyecto->fechaFin}}
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
            <div class="row ">
                <div class="col-md-12 text-center success">
                            {{ Form::label('actividades', 'Actividades:', array('class' => 'control-label col-md-3')) }} 
                </div>
            </div>
                <div class="row">              
                        <div class="form-group ">
                            <div class="col-md-12 productos">
                                @foreach($proyecto->actividades as $actividad)
                                    <div class="row">
                                        <div class="col-md-5">
                                            {{$actividad->nombre}}
                                        </div>
                                        <div class="col-md-3">
                                            {{$actividad->encargado}}
                                        </div>
                                        <div class="col-md-4">
                                           <input type="checkbox" name="actividad{{$actividad->id}}" {{$actividad->completo==0?:'checked'}}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    <div class="col-xs-12">
                    <div class="row col-md-12">
                            {{ Form::label('indicadores', 'Indicadores del Proyecto:', array('class' => 'control-label col-md-3')) }}
                            </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                @foreach($proyecto->indicadores as $indicador)
                                    <div class="row">
                                        <div class="col-md-5">
                                            {{$indicador->definicion->nombre}}
                                        </div>
                                        <div class="col-md-3">
                                            {{$indicador->meta}}
                                        </div>
                                        <div class="col-md-3">
                                           <?php

                                                if($indicador->definicion->tipo == 'Boolean')
                                                    echo "<input type='checkbox' value='1' name='indicador$indicador->id' ". ($indicador->detalles == 1?'checked':'') ." >";
                                                elseif($indicador->definicion->tipo == 'Dinero')
                                                    echo "<input type='number' step='any' name='indicador$indicador->id' value='$indicador->detalles'>";
                                                elseif($indicador->definicion->tipo == 'Numero')
                                                    echo "<input type='number' name='indicador$indicador->id' value='$indicador->detalles'>";
                                                elseif($indicador->definicion->tipo == 'Text')
                                                    echo "<input type='text' name='indicador$indicador->id' value='$indicador->detalles'>";
                                           ?>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>       
                        </div>
                    </div>
                </div>
            </div>
        </div
        <br>
    </div>
</div>


<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <center>
                        <a href="javascript:history.back()">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                         Anterior
                        </a>
                        </center>
                    </div>
                    <div class="col-xs-6">
                        <center>
                        <button type="submit" tabindex="11" class="btn btn-primary ladda-button" data-style="expand-right">
                        Siguiente
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                        </button>
                        </center>
                    </div>          
            </div>
        </div>
    </div>
</div>


{{Form::close()}}
@stop

