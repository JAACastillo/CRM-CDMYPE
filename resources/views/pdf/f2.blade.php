<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	     #header { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	       #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	    
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 13px; line-height: 15px}
	     #header .left {position: absolute; float: left}
	     #header .right {position: absolute; right: 10px}

	      #footer .left {float: left}
	     #footer .right {position: absolute; right: 10px}

	     .titulo{text-align:center; margin-bottom:0px}
	     .table, th {border: 1px solid black; margin: 0px; padding: 2px; font-size: 10px;}
	     .table, td {border: 1px solid black; margin: 0px; padding: 2px; font-size: 13px;}
	     .titulo {float: left;}
	      .firmas {text-align: center;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .empresario {border-bottom: solid 1px black; padding: 5px 10px;}
	     .acuerdo {padding: 10px}
	     .impacto {padding-left: 20px}
	     .acciones {padding: 10px 5px 10px 15px}
	     .cafe {background-color: #E0EAF1; text-align: center;}

	     .nombreProyecto{ padding-bottom: 20px; padding-top: 5px}
	   </style>

	<title>Formulario F2</title>
</head>
<body>

<div id="header" >
	<img src="assets/img/cdmype-logo.jpg" width="150px" />
</div>

<div id="footer">
	<img src="assets/img/conamype-logo.jpg" width="150px" class="left" />

	<img src="assets/img/unicaes-logo.jpg" width="75px" class="right" />

</div>


<h5 class="titulo">
		PLAN DE ACCIÓN PARA LA EJECUCIÓN DE PROYECTO DE MEJORA EMPRESARIAL
</h5>

<div id="contenido">

	<table>
		<tr>
			<td colspan="4"> Nombre de empresario/a: <strong>{{$empresario->nombre}} </strong></td>
		</tr>	
		<tr>
			<td colspan="4"> Nombre de la empresa, razón social o nombre comercial: <strong>{{$empresa->nombre}}</strong></td>
		</tr>	
		<tr>
			<td colspan="4"> Persona contacto: <strong>{{$empresario->nombre}} </strong></td>
		</tr>
		<tr>
			<td colspan="4" class="nombreProyecto"> Nombre de Proyecto: <strong>{{$proyecto->nombre}} </strong> </td>
		</tr>	
		<tr>
			<td colspan="4"> Fecha estimada de finalización: <strong>{{$proyecto->fechaFin}} </strong></td>
		</tr>	
		<tr >
			<td colspan="4" border="3" class="acuerdo"> El CDMYPE y  <strong><span class="empresario"> {{ $empresario->nombre }} </span> </strong>
			acordamos realizar las siguientes acciones, de la mejor manera posible, para la realización del proyecto arriba mencionado
			</td>
		</tr>

		<tr>
			<td class="cafe" width="40%">Acción a realizarse</td>
			<td class="cafe" width="30 %">Responsable (Asesor y/o empresa) </td>
			<td class="cafe" width="15%">Inicio</td>
			<td class="cafe" width="15%">Finalización</td>
		</tr>
		@foreach($actividades as $actividad)
			<tr>
				<td class="acuerdo"> <strong>{{$actividad->nombre}}</strong></td>
				<td> <strong>{{$actividad->encargado}}</strong></td>
				<td> <strong>{{$actividad->fecha}}</strong></td>
				<td> </td>
			</tr>
		@endforeach	
		<tr >
			<td colspan="4" border="3" class="acciones"> 
				Con este proyecto se esperan obtener los siguientes impactos en la empresa
			</td>
		</tr>
			<?php
			$impactos = explode("\r\n", $proyecto->descripcion);
			$num  = 1;
			?>
				@foreach($impactos as $impacto)
					<tr>
						<td colspan="4" class="impacto"> 
							{{$num++}}. <strong>{{$impacto}}</strong>
						</td>
					</tr>
				@endforeach

	</table>


<br/>
<br/>
	<table width="100%" border="none"> 
		<tr>
			<td width="20%" class="acuerdo">Firma de Cliente </td>
			<td class="firma" width="40%">________________________________</td> 
			<td class="date" width="40%"> Fecha: ______________________________</td>
		</tr>
		<tr>
			<td width="20%" class="acuerdo">Firma de Asesor(a) </td>
			<td class="firma" width="40%">________________________________</td> 
			<td class="date" width="40%"> Fecha: ______________________________</td>
		</tr>
		<tr>
			<td width="20%" class="acuerdo">Firma de director </td>
			<td class="firma" width="40%">________________________________</td> 
			<td class="date" width="40%"> Fecha: ______________________________</td>
		</tr>
	</table>
</div>
</body>
</html>






