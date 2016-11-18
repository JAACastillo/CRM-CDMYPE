<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
        @page { margin: 100px 90px; }
    	header {margin: 0px; position: fixed; left: 0px; top: -86px; right: 0px;  text-align: center; }
    	#titulo{text-align: center;}
    	section {font-family: "arial black" ; margin: 0px; padding: 0px; font-size: 14px; line-height: 20px; text-align: left;}
    	footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px;  }
    	footer .page:after { content: counter(page, upper-roman); }
    	footer #conamype {position: absolute; left: 10px;}
    	footer #cdmype {position: absolute; right: 10px;}
	    .firmas {text-align: center; left: 40%}
	   </style>

	<title>Contrato de trabajo</title>
</head>
<body>

{{-- Logos --}}
	<header> <img src="img/cdmype-logo.jpg" width="150px"/> </header>

	<footer>
		<img src="img/conamype-logo.jpg" width="150px" id="conamype" />
		<img src="img/unicaes-logo.jpg" width="75px" id="cdmype" />
	</footer>
{{-- Contenido --}}

	<?php
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$date = strtotime($acta->fecha);
		$dia = date('d', $date);
		$mes = $meses[date('m', $date) - 1];
		$ano = date('Y', $date);
	?>

<section>
	<h2 id="titulo">
		ACTA DE CONFORMIDAD DE ASISTENCIA TÉCNICA
	</h2>
		<br>
		<br>
		En Ilobasco, a los {{$dia}} días del mes de {{$mes}} del año {{$ano}}
		<br>
		<br>
		<br>

		<strong>{{$empresario->nombre}}</strong>, <br>
		NIT N° {{$empresario->nit}}, cuyo propietario/representante es <br>
		Sr(a) {{$empresario->nombre}}
		@if($empresario->nombre != $empresa->nombre)
			de <strong>{{$empresa->nombre}}</strong>, con
		@endif
		<br>
		DUI N°{{$empresario->dui}}
		<br>

		<br>
		<br>


		<?php
			$date = strtotime($contrato->fecha_inicio);
			$dia = date('d', $date);
			$mes = $meses[date('m', $date) - 1];
			$ano = date('Y', $date);
		?>
		<u>Declara <strong>aceptar</strong> a conformidad el trabajo</u> realizado por
		@if($consultor->sexo == 'Mujer')
			la consultora
		@else
			el consultor
		@endif

		<strong> {{$consultor->nombre}}</strong>, NIT
		{{$consultor->nit}}, de acuerdo al contrato suscrito con fecha {{$dia}} de {{$mes}} del {{$ano}}
		y autoriza al <strong> CDMYPE Ilobasco</strong>, hacer efectivo el pago de la suma de <strong> US$ {{round($contrato->pagoCdmype,2)}} </strong> que
		corresponde al cofinanciamiento del programa 
		@if($contrato->pagoEmpresario > 0)
			y la suma de <strong> US$ {{round($contrato->pagoEmpresario,2, PHP_ROUND_HALF_DOWN)}}</strong>, que corresponde al cofinanciamiento del aporte empresarial 
		@endif
		que he entregado para la realización de la asistecia técnica
		denominada <strong> "{{$at->tema}}"</strong> de la cual he recibido y aprobado el informe final.

	</p>
<br>
<br>
<br>
	<p>
		
		<u>Declara <strong>rechazar</strong> el trabajo</u> realizado por
		............................, NIT
		............................, de acuerdo al contrato suscrito con fecha .................
		, por las siguientes consideraciones: <br>
		a) <br>
		b) <br>
		c) <br>
		Por lo expuesto, se solicita al <strong> CDMYPE Ilobasco</strong>, retener los pagos correspondientes y mediar ante el consultor las acciones que se estimen pertinentes.
</p>
<br>
<br>
	<div class="firmas">
			F._____________________	<br/>
			{{$empresario->nombre}} <br/>
			NIT: {{$empresario->nit}} <br/>
			Empresario
	</div>
</div>
</body>
</html>
