<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	     #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 20px}
	     #footer .left {float: left}
	     #footer .right {position: absolute; right: 10px}

	   </style>

	<title>Contrato de trabajo</title>
</head>
<body>

<div id="header" >
	<img src="img/cdmype-logo.jpg" width="150px"/>
</div>

<div id="footer">
	<img src="img/conamype-logo.jpg" width="150px" class="left" />

	<img src="img/unicaes-logo.jpg" width="75px" class="right" />

</div>

				<?php
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					$date = strtotime($ampliacion->fecha);
					$dia = date('d', $date);
					$mes = $meses[date('m', $date) - 1];
					$ano = date('Y', $date);
				?>

<div id="contenido">
	<h4 style="text-align:center">
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
		Yo <strong>{{$solicitante->nombre}}</strong> en mi calidad de {{$solicitante->calidad }}, solicito una ampliación
		de {{$ampliacion->tiempo_ampliacion}} {{strtolower($ampliacion->periodo)}} para la finalización de la asistencia técnica
		llamada <strong>"{{$nombre}}"</strong>, por las siguientes razones.
		<br>
		<br>
		Razonamientos:
		<br>
		<br>
		{{$ampliacion->razonamiento}}
		<br>
		<br>
		<br>
		<br>

		Nombre del solicitante: <strong> {{$solicitante->nombre}} </strong> Firma:_______________________ <br>
		DUI y NIT del solicitante: DUI <strong>{{$solicitante->dui}}</strong>, NIT <strong>{{$solicitante->nit}}</strong>
		<br>
		<br>
		<br>
		<br>

		Visto bueno (Cliente o Consultor) ____________________________
		<br>
		<br>
		AUTORIZACIÓN DEL DIRECTOR DE CDMYPE __________________________
		
	</p>
<br>
<br>
<br>
<br>
</div>
</body>
</html>






