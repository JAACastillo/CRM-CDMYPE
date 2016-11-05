<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #footer {margin: 0px; position: fixed; left: 0px; top: 600px; right: 0px;  text-align: center; }
	     #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 13px; line-height: 15px}
	     #footer .left {position: absolute; float: left}
	     #footer .right {position: absolute; right: 10px}
	     .titulo{text-align:center; margin-bottom:0px; font-size: 16px}
	     .table, th {border: 1px solid black; margin: 0px; padding: 5px; font-size: 14px;}
	     .table, td {border: 1px solid black; margin: 0px; padding: 5px; font-size: 13px;}
	     #header{position: absolute; margin-top: -70px;}
	   </style>

	<title>Convocatoria</title>
</head>
<body>

<div id="header">
	<center><img src="assets/img/cdmype-logo.jpg" width="150px"/></center>
</div>
<div id="footer" >
	<img src="assets/img/conamype-logo.jpg" width="150px" height="100px" class="left"/>
	<img src="assets/img/unicaes-logo.jpg" width="75px" class="right" />
</div>

<h4 class="titulo">
		LISTA DE ASISTENCIA
</h4>

<div id="contenido">
	<div class="datos">

		<p><strong>Nombre de la Capacitación: </strong>{{$capacitacion->tema}}</p>
		<p>
			<strong>Fecha de Ejecución: </strong>{{ date("d-m-Y",strtotime($capacitacion->fecha));}}
			<strong> Lugar: </strong>{{$capacitacion->lugar}}
		</p>
		<p><strong>Nombre del Capacitador/a: </strong>{{$capacitacion->consultorSeleccionado->consultor->nombre}}</p>
	</div>
	<div class="asistencia">

		<table class="table">
			<thead>
				<tr>
					<th>N°</th>
					<th>Nombre del Participante</th>
					<th>Empresa</th>
					<th>Teléfono</th>
					<th>DUI</th>
					<th>NIT</th>
					<th>Firma</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$num=1;
				?>
				@foreach ($asistencias as $asistencia)
				<tr>
						<td style="text-align:center; width:20px">{{ $num }}</td>
						<td style="width:200px">{{ $asistencia->empresario->nombre }}</td>
						<td style="text-align:center; width:200px">
							@foreach($asistencia->empresario->empresa as $empresario)
                    			<h5 style="margin:0px;">{{ $empresario->empresas->nombre }}</h5>
                			@endforeach
						</td>
						<td style="text-align:center; width:70px">{{ $asistencia->empresario->telefono }} / {{$asistencia->empresario->celular}}</td>
						<td style="text-align:center; width:70px">{{ $asistencia->empresario->dui }}</td>
						<td style="text-align:center; width:110px">{{ $asistencia->empresario->nit }}</td>
						<td style="text-align:center; width:100px; color:white;">.</td>
				</tr>
				<?php
				$num++;
				?>
				@endforeach

			</tbody>
		</table>

	</div>

</div>
</body>
</html>
