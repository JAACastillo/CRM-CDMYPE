@extends('layouts.lista')

@section('titulo')
    CDMYPE - Lista de Empresas
@stop

@section('cabecera')
    Empresas
@stop

@section('boton')
    <a href="{{ url('crearEmpresa') }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Crear una nueva empresa">
    <span class="glyphicon glyphicon-plus"></span>
    Nueva
    </a>
@stop

@section('lista')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr class="active">
                <th class="text-center">Nombre</th>
                <th class="text-center">Propietario</th>
                <th class="text-center hidden-xs hidden-sm">Categoria</th>
                <th class="text-center hidden-xs hidden-sm">Direccion</th>
                <th class="text-center hidden-xs hidden-sm">Municipio</th>
                <th class="text-center hidden-xs hidden-sm">Departamento</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($empresas as $empresa)
            <tr>
                <td style="width:300px" >{{ $empresa->nombre }}</td>

                <td>
                @foreach($empresa->empresarios as $empresario)

                    <a  href="{{ route('editarEmpresario', array($empresario->empresarios->id)) }}"><h5>{{ $empresario->empresarios->nombre }} <small>{{$empresario->tipo}}</small></h5></a>

                @endforeach
                </td>


                <td class="text-center hidden-xs hidden-sm">{{ $empresa->categoria }}</td>
                <td class="text-center hidden-xs hidden-sm">{{ $empresa->direccion}}</td>
                <td class="text-center hidden-xs hidden-sm">{{ $empresa->municipio->municipio }}</td>
                <td class="text-center hidden-xs hidden-sm">{{ $empresa->municipio->departamento->departamento }}</td>
                <td class="text-center">
                    <a href="{{ route('editarEmpresa', array($empresa->id)) }}" class="btn btn-default btn-xs glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="left" title="Editar"> </a>
                    <a href="{{ route('verEmpresa', array($empresa->id)) }}" class="btn btn-default btn-xs glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Ver"> </a>
                    @if(Auth::user()->tipo == 'Administrador')
                    <a href="{{ route('eliminarEmpresa', array($empresa->id)) }}" class="btn btn-default btn-xs glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="right" title="Eliminar" onClick = "return confirm('¿Desea eliminar la Empresa?');"> </a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $empresas->links() }}

@stop
