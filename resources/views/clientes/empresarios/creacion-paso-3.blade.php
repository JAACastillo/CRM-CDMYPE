@extends('menu')

@section('escritorio')

@include('clientes.empresarios.pasos')

<div>


@include('errores', array('errors' => $errors))
{{ Form::model($empresaEmpresario, array('route' => 'pasoGuardarSocios', 'method' => 'POST', 'id' => 'validar2', 'class' => 'form-horizontal','role' => 'form')) }}

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
				<div class="row col-xs-12" >
					<div class="col-xs-12">
					    <br/>
				        {{ Form::open(array('url' => '/buscar', 'method' => 'post', 'role' => 'search')) }}

				        <div class="form-group">
					        {{ Form::label('empresario_id', 'Nombre:', array('class' => 'control-label col-md-4')) }}
					        <div class="col-md-6">
					        	{{ Form::text('empresario', null, array('placeholder' => 'Nombre del Empresario', 'class' => 'form-control getEmpresario', 'data-url' => 'empresario')) }}

					            {{ Form::hidden('empresario_id', null) }}
					        </div>
					    </div>

						{{ Form::close() }}

							<div class="form-group">
			                {{ Form::label('tipo', 'Tipo:', array('class' => 'control-label col-md-4')) }}
			                <div class="col-md-6">
			                    {{ Form::select('tipo', array('' => 'Seleccione una opción','1' => 'Empresario','2' => 'Empresaria','3' => 'Propietario','4' => 'Propietaria','5' => 'Representante'), null, array('class' => 'form-control', 'data-placeholder' => 'Seleccione un tipo')) }}
			                </div>
			            </div>

		                	{{ Form::hidden('empresa_id', $empresaEmpresario->empresa_id) }}

		            </div>
		            <!-- Tabla de Socios -->
		            <div class="col-xs-1"></div>
		            <div class="col-xs-10">
		            	<?php
    		        		$empleados = EmpresaEmpresario::Where('empresa_id', '=', $id)->get();
                		?>
                		@if($empleados!="[]")
		            	<div class="table-responsive">
					        <table class="table table-bordered">
					            <tr class="active">
					                <th class="text-center">Nombre</th>
					                <th class="text-center">Tipo</th>
					            </tr>

					            @foreach ($empleados as $empleado)
					            <tr>
					                <td>&nbsp &nbsp &nbsp <a href="{{ route('editarEmpresario', array($empleado->empresarios->id)) }}">{{ $empleado->empresarios->nombre}} </a></td>
					                <td class="text-center">{{ $empleado->tipo }}</td>
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
    $empresario = new Empresario;

    $sexos = array(1 => 'Mujer', 2 => 'Hombre');
    $tipos = array(1 => 'Empresaria', 2 => 'Propietaria', 3 => 'Representante', 4 => 'Empresario', 5 => 'Propietario');
    $departamentos = array('' => 'Seleccione una opción' ) + Departamento::all()->lists('departamento', 'id');
    $municipios = array('' => 'Seleccione una opción' ) + Municipio::all()->lists('municipio', 'id');

    $empresario->sexo = array_search($empresario->sexo,$sexos);
    $empresario->tipo = array_search($empresario->tipo,$tipos);
    $empresario->municipio = array_search($empresario->municipio_id, $municipios);
?>

{{ Form::open(array('route' => array('pasoSocios', $empresaEmpresario->empresa_id), 'method' => 'POST', 'id' => 'validar', 'class' => 'form-horizontal','role' => 'form')) }}
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
               	@include('clientes/empresarios/form')
               		<div class="form-group">
			                {{ Form::label('tipo2', 'Tipo:', array('class' => 'control-label col-md-4')) }}
			                <div class="col-md-5">
			                    {{ Form::select('tipo2', array('' => 'Seleccione una opción','1' => 'Empresario','2' => 'Empresaria','3' => 'Propietario','4' => 'Propietaria','5' => 'Representante'), null, array('class' => 'form-control', 'data-placeholder' => 'Seleccione un tipo', 'required')) }}
			                </div>
			            </div>
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
@include('validaciones.empresarios')
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
