<?php 
	$pasos  = array(
				    array(
				        "label"  => "Empresa",
				        "enlace" => "editarEmpresa",
				        "rows"   => 2
				    ),
				    array(
				        "label" => "Empresario",
				        "enlace" => "pasoEmpresarios",
				        "rows"   => 3
				    ),
				    array(
				        "label" => "Indicadores",
				        "enlace" => "empresaPasoIndicadores",
				        "rows"   => 2
				    ),
				    array(
				        "label" => "Proyecto",
				        "enlace" => "empresaProyectos",
				        "rows"   => 2
				    ),
				    array(
				        "label" => "Terminos",
				        "enlace" => "pasoTerminoEmpresa",
				        "rows"   => 3
				    )
				);
	$step = 1;

?>

<div class="row">
	<div class="btn-group col-xs-12">
	 	@foreach($pasos as $paso)

		  	<a href="{{route($paso['enlace'], $id)}}" type="button"  
		  		{{($step > $pasoReal ? 'disabled' : '')}} 
		  		class="{{($pasoActual == $step ? 'active btn btn-primary' : 'btn btn-default')}}  
		  		col-sm-{{$paso['rows']}}">
		  		Paso {{$step++}}<br/> 
		  		<strong> {{$paso['label']}} </strong>
		  	</a>
		@endforeach

	</div>
</div>