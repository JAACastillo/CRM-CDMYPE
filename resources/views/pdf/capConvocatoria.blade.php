<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -86px; right: 0px;  text-align: center; }
	     #header { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 13px; line-height: 15px}
	     #header .left {position: absolute; float: left}
	     #header .right {position: absolute; right: 10px}
	     .titulo{text-align:center; margin-bottom:0px}
	     .table, th {border: 1px solid black; margin: 0px; padding: 2px; font-size: 10px;}
	     .table, td {border: 1px solid black; margin: 0px; padding: 2px; font-size: 13px;}
	   </style>

	<title>Convocatoria</title>
</head>
<body>

<div id="header" >
	<img src="assets/img/cdmype-logo.jpg" width="150px" class="left"/>
	<img src="assets/img/unicaes-logo.jpg" width="75px" class="right" />
</div>
<h4 class="titulo">
		FORMATO DE CONVOCATORIA A CLIENTES
</h4>

<div id="contenido">
	<div class="datos">

		<p><strong>Nombre de la Actividad: </strong>{{$capacitacion->tema}}</p>
		<p><strong>Objetivo: </strong>{{$capacitacion->obj_general}}</p>
		<p><strong>Dirigido a: </strong>{{$capacitacion->categoria}}</p>
		<p><strong>Importancia para el empresario/a: </strong>{{$capacitacion->obj_especifico}}</p>
		<p><strong>Lugar: </strong>{{$capacitacion->lugar}}
			<strong> Fecha: </strong>{{ date("d-m-Y",strtotime($capacitacion->fecha));}}
			<strong> Hora: </strong>{{ date("g:i a",strtotime($capacitacion->hora_ini)); }} a {{ date("g:i a",strtotime($capacitacion->hora_fin));}}
		</p>

	</div>
	<div class="asistencia">
		<table class="table">
			<thead >
				<tr>
					<th>N°</th>
					<th>NOMBRE</th>
					<th>EMPRESA/S</th>
					<th>TELÉFONO</th>
					<th>CORREO ELÉCTRONICO</th>
					<th>DUI</th>
					<th>NIT</th>
					<th>CONFIRMACIÓN DE ASISTENCIA</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$num=1;
				?>
				@foreach ($asistencias as $asistencia)
				<tr>
						<td style="text-align:center; width:20px">{{ $num }}</td>
						<td style="width:170px">{{ $asistencia->empresario->nombre }}</td>
						<td style="text-align:center; width:100px">
							@foreach($asistencia->empresario->empresa as $empresario)
                    			<h5 style="margin:0px; width:100px">{{ $empresario->empresas->nombre }}</h5>
                			@endforeach
						</td>
						<td style="text-align:center; width:70px">{{$asistencia->empresario->telefono}} / {{$asistencia->empresario->celular}}</td>
						<td style="text-align:center; width:100px">{{ $asistencia->empresario->correo }}</td>
						<td style="text-align:center; width:70px">{{ $asistencia->empresario->dui }}</td>
						<td style="text-align:center; width:110px">{{ $asistencia->empresario->nit }}</td>
						<td style="text-align:center; width:100px"> </td>
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






