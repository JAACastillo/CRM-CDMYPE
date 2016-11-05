<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style>
	    @page { margin: 100px 90px; }
	    #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	    #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	    #footer .page:after { content: counter(page, upper-roman); }
	    #contenido {font-family: "arial black" ;margin: 10px; padding: 0px; text-align:justify; font-size: 14px; line-height: 20px}
	    #titulo{background-color: #CCFAE0; border: 2px solid black; text-align: center;}
	    #footer .left {float: left}
	    #footer .right {position: absolute; right: 10px}

	   </style>

	<title>Término de referencia para Asistencia Técnica</title>
</head>
<body>

	<div id="header" >
		<img src="img/cdmype-logo.jpg" width="150px"/>
	</div>

	<div id="footer">
		<img src="img/conamype-logo.jpg" width="200px" class="left" />
		<img src="img/unicaes-logo.jpg" width="75px" class="right" />
	</div>

	<div id="contenido">

		<div id="titulo">
			<h4> TÉRMINOS DE REFERENCIA</h4>
			<p><b> "{{$at->tema}}" </b></p>
		</div>

	 	<p><b>1. Presentación</b></p>
	 	<p> {{$at->empresa->descripcion}} </p>


	 	<p><b>1. Objetivos</b></p>

	 	<p><b>1.1 Objetivo General </b></p>
	 	<p> {{$at->obj_general}} </p>
	 	<p><b> 1.2 Objetivos Específicos </b></p>
	 		<?php $especificos = explode("\r\n", $at->obj_especifico) ?>
			<ul>
				@foreach($especificos as $especifico)
					<li>
						{{$especifico}}
					</li>
				@endforeach
			</ul>

	 	<p><b>2. Productos Esperados</b></p>
	 	<p>
	 		Al finalizar la asistencia técnica, donde el consultor contratado deberá hacer visitas in situ para desarrollar el trabajo siguiente:
	 		<?php $productos = explode("\r\n", $at->productos) ?>
			<ul>
				@foreach($productos as $producto)
					<li>
						{{$producto}}
					</li>
				@endforeach
			</ul>
	 	</p>


		<p><b>3. Oferta técnica y económica</b></p>
			La oferta técnica y económica deberá ser presentada de acuerdo al siguiente contenido, ver anexo de oferta:
			<ul>
				<li>Descripción de la empresa(s).</li>
				<li>Objetivos.</li>
				<li>Metodología de trabajo.</li>
			<li>Productos esperados.</li>
			<li>Plan de trabajo de la asistencia técnica.</li>
			</ul>

	 		<p><b>4. Tiempo de ejecución de la asistencia técnica: </b></p>
	 		<p> En {{$at->tiempo_ejecucion}} semanas, con un minimo de 30 horas, de las cuales el {{$at->trabajo_local}}% debe ser trabajo en el local del empresario, y el {{100 - $at->trabajo_local}}% restante trabajo en oficina para redacción de informes y cualquier otro trabajo que el proceso requiera. Esta relación puede variar dependiendo del tipo de trabajo a realizar y debe ir justificado en la planificación de actividades de la oferta técnica.</p>

	 		<p><b>5. Plazo de presentación de ofertas:  </b></p>
	 		<p>
	 			Presentar su oferta Técnica y Económica a mas tardar en la fecha {{$at->fecha}}, ya sea por medio electrónico a cdmype.unicaes@gmail.com, {{$at->usuario->email}} o físico en la oficina CDMYPE ubicada en Universidad Católica de El Salvador-Centro Regional Ilobasco.
	 			No se tomaran en cuenta las ofertas sin firma del consultor, ni ofertas recibidas después de la fecha establecida.

	 		</p>

	 		<p><b>6. Financiamiento:  </b></p>
	 		<p>
	 			El valor máximo a cofinanciar por el desarrollo de la asistencia técnica es de <b>${{$at->financiamiento}}</b>.
	 			@if( $at->aporte > 0)
	 				Más un aporte empresarial de <b>{{$at->aporte}} %</b>
	 			@endif
	 		</p>

	</div>
</body>
</html>






