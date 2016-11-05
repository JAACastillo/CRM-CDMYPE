@extends('menu')

@section('escritorio')

@include('clientes.empresas/pasos')

<div>
<br/>

    <a href="{{ route('empresaPasoProyecto', $id) }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo Proyecto">
    <span class="glyphicon glyphicon-plus"></span>
    Nuevo
    </a>


    <div class="table-responsive">
        <br>
        <table class="table table-bordered">
            <tr class="active">
                <th class="text-center">Nombre</th>
                <th class="text-center">Asesor</th>
                <th class="text-center">Indicadores</th>
                <th class="text-center">Actividades</th>
                <th class="text-center">Fecha Inicio</th>
                <th class="text-center">Fecha Fin</th>
                <th class="text-center">Completado</th>
                <th class="text-center">Opciones</th>
            </tr>

            @foreach ($proyectos as $proyecto)
            <tr>
                <td>
                    <a href="{{route('empresaPasoSeguimientoProyecto', $proyecto->id)}}">
                    {{ $proyecto->nombre }}
                    </a>
                </td>
                <td>{{ $proyecto->encargado->nombre }}</td>
                <td >
	                    @foreach($proyecto->indicadores as $indicador)
	                    	<div class="row col-md-12">
                                <div class="col-md-9">{{ $indicador->definicion->nombre }} </div>
                                <div class="col-md-3">{{$indicador->meta}} </div>
                            </div>
	                    @endforeach
                </td>
                <td >
                	<ul>
	                    @foreach($proyecto->actividades as $actividad)
	                    	<li>{{ $actividad->nombre }} </li>
	                    @endforeach
                    </ul>
                </td>
                <?php 
                    $avance = $proyecto->avance;
                ?>
                <td class="text-center">{{ $proyecto->fechaInicio }}</td>
                <td class="text-center">{{ $proyecto->fechaFin }}</td>
                <td class="text-center">{{ $avance}} %</td>
                <td class="text-center">
                	<a href="{{route('empresaF2', $proyecto->id)}}" target="_blank" class="btn btn-default btn-xs"> F2</a>
                    @if($avance == '0')
                        <a href="{{ route('empresaPasoProyectoEditar', $proyecto->id) }}" class="btn btn-default btn-xs glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="left" title="Editar"> </a>
                    @endif
                </td>
                
            </tr>
            @endforeach

        </table>
    </div>
    {{-- Paginar Con el valor Puesto en Modelo en la variable perPage--}}
    

@stop