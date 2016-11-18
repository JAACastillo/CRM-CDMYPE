<!DOCTYPE html>
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
	     .table {border-collapse: collapse;}
	     .table, th {border: 1px solid black; margin: 0px; padding: 2px; font-size: 12px;}
	     .table, td {border: 1px solid black; margin: 0px; padding: 2px; font-size: 13px;}
	   </style>

	<title>Participantes a evento </title>
</head>
<body>

<div id="header" >
	<img src="img/cdmype-logo.jpg" width="150px" class="left"/>
	<img src="img/unicaes-logo.jpg" width="75px" class="right" />
</div>

<h4 class="titulo">
		FORMATO DE CONVOCATORIA A CLIENTES
</h4>

<div id="contenido">
	<div class="datos">

		<p><strong>Nombre del evento:</strong> {{$evento->nombre}}</p>
		<p><strong>Descripción:</strong> {{$evento->descripcion}}</p>
		<p><strong>Organizado por:</strong> {{$evento->tipo}}</p>
		<p><strong>Lugar:</strong> {{$evento->lugar}}
		   <strong>Fecha:</strong> {{ date("d-m-Y", strtotime($evento->fecha)) }}
		</p>

	</div>
	<div class="asistencia">

		<table class="table">
			<thead >
				<tr>
					<th>N°</th> <th>NOMBRE</th> <th>EMPRESA/S</th> <th>TELÉFONO</th> <th>CORREO ELÉCTRONICO</th>
					<th>DUI</th> <th>NIT</th> <th>SECTOR ECONOMICO</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($asistencias as $key=>$asistencia)
				<tr>
					<td style="text-align:center; width:20px">{{ ++$key }}</td>
					<td style="width:150px">{{ $asistencia->empresarios->nombre }}</td>
					<td style="text-align:center; width:100px">
						@foreach($asistencia->empresarios->empresas as $empresa)
                			<p>{{ $empresa->empresa }}</p>
            			@endforeach
					</td>
					<td style="text-align:center; width:70px">
						{{$asistencia->empresarios->telefono}}<br>
						{{$asistencia->empresarios->celular}}
					</td>
					<td style="text-align:center; width:100px">{{ $asistencia->empresarios->correo }}</td>
					<td style="text-align:center; width:70px">{{ $asistencia->empresarios->dui }}</td>
					<td style="text-align:center; width:110px">{{ $asistencia->empresarios->nit }}</td>
					<td style="text-align:center; width:150px"> 
						@foreach($asistencia->empresarios->empresas as $empresa)
                			<p>{{ $empresa->sector }}</p>
            			@endforeach
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</div>
</body>
</html>






