<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<style>
	    @page { margin: 100px 90px; }
	    header {margin: 0px; position: fixed; left: 0px; top: -86px; right: 0px;  text-align: center; }
	    #titulo {text-align: center;}
	    section {font-family: "arial black" ; margin: 0px; padding: 0px; font-size: 14px; line-height: 20px; text-align: left;}
		footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px;  }
		footer .page:after { content: counter(page, upper-roman); }
		footer #conamype {position: absolute; left: 10px;}
		footer #cdmype {position: absolute; right: 10px;}

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
		$date = strtotime($ampliacion->fecha);
		$dia = date('d', $date);
		$mes = $meses[date('m', $date) - 1];
		$ano = date('Y', $date);
	?>

<section>
	<h4 id="titulo">
		SOLICITUD DE AMPLIACIÓN DE CONTRATO
	</h4>

		<br>
		<br>
		Fecha {{$dia}} días del mes de {{$mes}} del año {{$ano}}
		<br>
		<br>
		<br>

		Estimados señores <strong>CDMYPE UNICAES Ilobasco</strong>
	<br>
	<br>
		Yo <strong>{{$solicitante->nombre}}</strong> en mi calidad de {{$ampliacion->solicitante }}, solicito una ampliación
		de {{$ampliacion->tiempo_ampliacion}} {{strtolower($ampliacion->periodo)}} para la finalización de la asistencia técnica
		llamada <strong>"{{$at->tema}}"</strong>, por las siguientes razones.
		<br>
		<br>
		Razonamientos:
		<br>
		<br>
			<ul>
				@foreach($ampliacion->razonamientos as $razonamiento)
					<li>
						{{$razonamiento}}
					</li>
				@endforeach
			</ul>
		<br>
		<br>
		<br>

		Nombre del solicitante: <strong> {{$solicitante->nombre}} </strong> Firma:_______________________ <br>
		DUI y NIT del solicitante: DUI <strong>{{$solicitante->dui}}</strong>, NIT <strong>{{$solicitante->nit}}</strong>
		<br>
		<br>

		Visto bueno (Cliente o Consultor) ____________________________
		<br>
		<br>
		AUTORIZACIÓN DEL DIRECTOR DE CDMYPE __________________________
		
	</p>

</section>
</body>
</html>






