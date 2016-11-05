@extends('menu')

@section('escritorio')

@include('clientes.empresarios/pasos')

<div>

@include('errores', array('errors' => $errors))
{{ Form::model($empresaEmpresario, array('route' => 'pasoGuardarEmpresa', 'method' => 'POST', 'id' => 'validar2', 'class' => 'form-horizontal','role' => 'form')) }}

<div class="row visible buscar">
	<div class="col-xs-1"></div>
	<div class="col-xs-10">
		<div class="panel panel-default">
		<div class="panel-heading">
			<a href="#" tabindex="11" class="btn btn-default busqueda resetBtn">
		        <span class="glyphicon glyphicon-plus"></span>
		        Crear
		    </a>
		</div>
			<div class="panel-body">
				<div class="row" >
					<br/>
					<div class="col-xs-12">
			        {{ Form::open(array('url' => '/buscar', 'method' => 'post', 'role' => 'search')) }}

			        <div class="form-group">
				        {{ Form::label('empresa_id', 'Nombre:', array('class' => 'control-label col-md-4')) }}
				        <div class="col-md-6">
				            {{ Form::text('empresa', null, array('placeholder' => 'Nombre de la Empresa o Grupo', 'class' => 'form-control getEmpresa', 'data-url' => 'empresa')) }}
				            {{ Form::hidden('empresa_id', null) }}
				        </div>
				    </div>

					{{ Form::close() }}

					<div class="form-group">
		                {{ Form::label('tipo', 'Tipo:', array('class' => 'control-label col-md-4')) }}
		                <div class="col-md-6">
		                    {{ Form::select('tipo', array('' => '','1' => 'Empresario','2' => 'Empresaria','3' => 'Propietario','4' => 'Propietaria','5' => 'Representante'), null, array('class' => 'form-control', 'data-placeholder' => 'Seleccione un tipo')) }}
		                </div>
		            </div>

		            	{{ Form::hidden('empresario_id', $empresaEmpresario->empresario_id) }}
	            	</div>

	            	<!-- Tabla de Socios -->
		            <div class="col-xs-1"></div>
		            <div class="col-xs-10">
		            	<?php
    		        		$empresas = EmpresaEmpresario::Where('empresario_id', '=', $id)->get();
                		?>
                		@if($empresas!="[]")
		            	<div class="table-responsive">
					        <table class="table table-bordered">
					            <tr class="active">
					                <th class="text-center">Nombre</th>
					            </tr>

					            @foreach ($empresas as $empresa)
					            <tr>
					                <td class="text-center"> <a href="{{ route('editarEmpresa', array($empresa->empresas->id)) }}">{{ $empresa->empresas->nombre}}</a> </td>
					            </tr>
					            @endforeach

					        </table>
					    </div>
					    @endif

		            </div>
		            <div class="col-xs-1"></div>

	            </div>

			<div class="row">
				    <div class="col-xs-6">
				    	<br/>
				        <center>
				        <a href="javascript:history.back()">
				        <span class="glyphicon glyphicon-chevron-left"></span>
				         Anterior
				        </a>
				        </center>
				    </div>
				    <div class="col-xs-6">
				    	<br/>
				        <center>
				        <button type="submit" tabindex="11" class="btn btn-primary ladda-button" data-style="expand-right">
				        Siguiente
				        <span class="glyphicon glyphicon-chevron-right"></span>
				        </span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
				        </button>
				        </center>
				    </div>
			</div>
			</div>
		</div>
		</div>
	<div class="col-xs-1"></div>
</div>
{{ Form::close() }}

<?php
	$empresa = new Empresa;

    $tipos = array(1 => 'Empresaria', 2 => 'Propietaria', 3 => 'Representante', 4 => 'Empresario', 5 => 'Propietario');
    $departamentos = array('' => 'Seleccione una opción' ) + Departamento::all()->lists('departamento', 'id');
    $municipios = array('' => 'Seleccione una opción' ) + Municipio::all()->lists('municipio', 'id');
    $Categoria = array('' => 'Seleccione una opción','1' => 'Empresa','2' => 'Grupo','3' => 'Individual','4' => 'Emprendedor', '5' => 'Cooperativa');
    $Clasificacion = array(
	        						1 => 'Emprendedor',
	        						2 => 'Micro-empresa',
	        						3 => 'Subsistencia',
	        						4 => 'Grupo Asociativo Empresas',
	            					5 => 'Pequeña Empresa');
    $constitucion = array('' => 'Seleccione una opción', 1 => 'Persona Natural', 2 => 'Persona Juridica', 3 => 'Gpo de empresas', 4 => 'Gpo de Emprendedores', 5 => 'UDP', 6 => 'Informal Natural' );

?>

{{ Form::open(array('route' => array('pasoEmpresa', $empresaEmpresario->empresario_id), 'method' => 'POST', 'id' => 'validar', 'class' => 'form-horizontal','role' => 'form')) }}
<br>
<div class="row oculto empresario" id="empresario">
	<div class="col-xs-1"></div>
	<div class="col-xs-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="#" tabindex="11" class="btn btn-default busqueda resetBtn">
			        <span class="glyphicon glyphicon-search"></span>
			        Buscar
			    </a>
			</div>
				<div class="panel-body">
					<div class="row">
               	<div class="col-md-12">
               		@include('clientes/empresas/form')

               	</div>
               </div>
				</div>
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
				        	Guardar
				        <span class="glyphicon glyphicon-chevron-right"></span>
				        </span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
				        </button>
				        </center>
				    </div>
			</div>
			<br>
    	</div>
	</div>
	<div class="col-xs-1"></div>
</div>
{{ Form::close() }}
@stop


@section('script')
@include('validaciones.empresasEmpresarios')
@include('validaciones.empresas')
<script type="text/javascript">
$('.busqueda').on('click', function(){
	$('#empresario').toggle("blind");
	$('.buscar').toggle("blind")
});

$('.resetBtn').click(function() {
        $('#validar').data('bootstrapValidator').resetForm(true);
        $('#validar2').data('bootstrapValidator').resetForm(true);
});

</script>
@stop
