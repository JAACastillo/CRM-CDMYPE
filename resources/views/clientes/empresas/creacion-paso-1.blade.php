@extends('menu')

@section('escritorio')

@include('clientes.empresas/pasos')

<br/>
{{ Form::model($empresa, $accion) }}
@include('errores', array('errors' => $errors))


@include('clientes/empresas/form')

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
				        <button type="submit" tabindex="11" class="btn btn-primary ladda-button" data-style="expand-right">
				        Siguiente
				        <span class="glyphicon glyphicon-chevron-right"></span>
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

@section('script')
@include('validaciones.empresas')
@stop

@stop