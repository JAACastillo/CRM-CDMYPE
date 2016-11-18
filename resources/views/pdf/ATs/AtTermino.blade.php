<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<style>
	    @page { margin: 100px 90px; }
		header {margin: 0px; position: fixed; left: 0px; top: -86px; right: 0px;  text-align: center; }
		#titulo{background-color: #CCFAE0; border: 2px solid black; text-align: center;}
		section {font-family: "arial black" ; margin: 0px; padding: 0px; font-size: 14px; line-height: 20px; text-align: left;}
		footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px;  }
		footer .page:after { content: counter(page, upper-roman); }
		footer #conamype {position: absolute; left: 10px;}
		footer #cdmype {position: absolute; right: 10px;}
	   </style>

	<title>Término de referencia para Asistencia Técnica</title>
</head>
<body>

{{-- Logos --}}
	<header> <img src="img/cdmype-logo.jpg" width="150px"/> </header>

	<footer>
		<img src="img/conamype-logo.jpg" width="150px" id="conamype" />
		<img src="img/unicaes-logo.jpg" width="75px" id="cdmype" />
	</footer>
{{-- Contenido --}}

	<section>
		<div id="titulo">
			<h4>TÉRMINOS DE REFERENCIA</h4>
			<h3> "{{$at->tema}}" </h3>
		</div>
		
		<article>
		 	<h3>1. Presentación</h3>
		 	<p> {{$at->empresa->descripcion}} </p>
		</article>

		<article>
		 	<h3>1. Objetivos</h3>
		 	<h3>1.1 Objetivo General </h3>
		 	<p> {{$at->obj_general}} </p>
		 	<h3> 1.2 Objetivos Específicos </h3>
				<ul>
					@foreach($at->especificos as $especifico)
						<li>
							{{$especifico}}
						</li>
					@endforeach
				</ul>
		</article>
		
		<article>
		 	<h3>2. Productos Esperados</h3>
		 	<p>
		 		Al finalizar la asistencia técnica, donde el consultor contratado deberá hacer visitas in situ para desarrollar el trabajo siguiente:
		 	</p>
				<ul>
					@foreach($at->productos as $producto)
						<li>
							{{$producto}}
						</li>
					@endforeach
				</ul>
		</article>

		<article>
			<h3>3. Oferta técnica y económica</h3>
			<p>La oferta técnica y económica deberá ser presentada de acuerdo al siguiente contenido, ver anexo de oferta:</p>
			<ul>
				<li>Descripción de la empresa(s).</li>
				<li>Objetivos.</li>
				<li>Metodología de trabajo.</li>
				<li>Productos esperados.</li>
				<li>Plan de trabajo de la asistencia técnica.</li>
			</ul>
		</article>
			
		<article>
	 		<h3>4. Tiempo de ejecución de la asistencia técnica: </h3>
	 		<p> En {{$at->tiempo_ejecucion}} semanas, con un minimo de 30 horas, de las cuales el {{$at->trabajo_local}}% debe ser trabajo en el local del empresario, y el {{100 - $at->trabajo_local}}% restante trabajo en oficina para redacción de informes y cualquier otro trabajo que el proceso requiera. Esta relación puede variar dependiendo del tipo de trabajo a realizar y debe ir justificado en la planificación de actividades de la oferta técnica.</p>
		</article>
		<article>
	 		<h3>5. Plazo de presentación de ofertas:  </h3>
	 		<p>
	 			Presentar su oferta Técnica y Económica a mas tardar en la fecha {{$at->fecha}}, ya sea por medio electrónico a cdmype.unicaes@gmail.com, {{$at->usuario->email}} o físico en la oficina CDMYPE ubicada en Universidad Católica de El Salvador-Centro Regional Ilobasco.
	 			No se tomaran en cuenta las ofertas sin firma del consultor, ni ofertas recibidas después de la fecha establecida.

	 		</p>
		</article>
		<article>
	 		<h3>6. Financiamiento:  </h3>
	 		<p>
	 			El valor máximo a cofinanciar por el desarrollo de la asistencia técnica es de <b>${{$at->financiamiento}}</b>.
	 			@if( $at->aporte > 0)
	 				Más un aporte empresarial de <b>{{$at->aporte}} %</b>
	 			@endif
	 		</p>
		</article>

	</section>
</body>
</html>






