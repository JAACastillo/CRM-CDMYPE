<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	     /*#footer { position: fixed; left: 0px; bottom: -160px; right: 0px; height: 150px;  }*/
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 20px}
	     #footer .left {float: left}
	     #footer .right {position: absolute; right: 10px}

	     .firmas {text-align: center;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .empresario {left: 35%}
	     .consultor {right: 0}

	     .clausula {color: #707070; padding-bottom: -10px; }
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
		$date = strtotime($contrato->fecha_inicio);
		$dia = date('d', $date);
		$mes = $meses[date('m', $date) - 1];
		$ano = date('Y', $date);
	?>

<div id="contenido">
	<h4 style="text-align:center">
		CONTRATO PROFESIONAL ENTRE EMPRESARIO, CONSULTOR Y EL CDMYPE PARA LA
		PRESTACIÓN DE SERVICIOS DE ASISTENCIA TÉCNICA
	</h4>

	<p>
	NOSOTROS, Universidad Católica de El Salvador y CDMYPE-Ilobasco, en su calidad de Centro de
	Desarrollo de la Micro y Pequeña Empresa CDMYPE y

	@if($consultor->empresa)
		la empresa {{$consultor->empresa}} con número de Registro Tributario {{$consultor->iva}}, representada por
	@endif

	{{$consultor->nombre}},
	mayor de edad, de nacionalidad salvadoreña, del domicilio de
	{{$consultor->direccion}}
	con Documento Único de Identidad (DUI), número
	{{$consultor->dui}}, quien en adelante se denominará {{$consultor->denominacion}}, convenimos celebrar el presente contrato con el objeto de que realice a favor
	y a satisfacción de

	@if($empresa->categoria == 'Individual')
		@if($empresario->sexo == 'Mujer')
			la empresaria:
		@else
			el empresario:
		@endif
	@else
		la empresa:
		{{$empresa->nombre}}
		, ubicado en
		{{$empresa->direccion}},
		en el Municipio de {{$empresa->municipio}}, departamento de {{$empresa->municipio}},
		representado por
	@endif

	{{$empresario->nombre}}, mayor de edad, de nacionalidad salvadoreña, del domicilio de {{$empresario->municipio->municipio }} en el departamento

	{{$empresario->municipio->departamento->departamento}}
	con Documento Único de Identidad (DUI), número {{$empresario->dui}}, la asistencia técnica
	denominada: "<em>{{$at->tema}}</em> "

	<span style="display: block;">Las partes sujetamos el contrato en referencia a las siguientes cláusulas:</span>


	<p class="clausula">PRIMERA: PRODUCTOS ESPERADOS </p>

	Los productos esperados a realizar por {{$consultor->denominacion}} son los siguientes de acuerdo a los solicitados en los TDR:

		<?php $productos = explode("\r\n", $at->productos) ?>
		<ul>
			@foreach($productos as $producto)
				<li>
					{{$producto}}
				</li>
			@endforeach
		</ul>

	<p class="clausula"> SEGUNDA: PLAZO </p>


	El presente contrato tendrá una duración de {{$contrato->duracion}} semanas, en el cual se completará la asistencia
	técnica brindada a partir de {{$dia}} de {{$mes}} de {{$ano}}. Durante este período {{$consultor->denominacion}} se compromete a hacer
	cumplir las actividades objeto de este contrato contenidas en la oferta técnica y económica y a dar fiel
	cumplimiento a los compromisos establecidos en los planes de trabajo aprobados y productos esperados.
	Si por algún motivo, la consultoría deberá superar el plazo acordado para su finalización, cualquiera de
	las partes podrá solicitar al CDMYPE una extensión del plazo, argumentando los motivos de tal solicitud.
	El CDMYPE determinará la validez o no dicha solicitud.


<br/>
	<p class="clausula">TERCERA: INFORMES </p>

	<?php echo ucfirst($consultor->denominacion) ?>  se obliga a presentar en tiempo y forma a {{$empresario->nombre}} y al CDMYPE-Ilobasco
	un informe final de la asistencia técnica. El trabajo debe de hacerse de conformidad con el plan de trabajo
	previamente acordado entre el empresario y {{$consultor->denominacion}}, el cual forma parte de este contrato.



<br/>
	<p class="clausula">CUARTA: FORMA DE PAGO </p>

	El CDMYPE-Ilobasco, en virtud de este contrato y una vez {{$empresario->nombre}}, manifieste por
	escrito su conformidad con el servicio recibido y con el visto bueno del CDMYPE-Ilobasco, pagará a 
	{{$consultor->denominacion}} en concepto de honorarios por la asistencia técnica efectuada, la cantidad de $
	<?php if ($at->aporte != 0) {
		echo round($contrato->pagoCdmype,2);
	}else{
		echo round($contrato->pago,2);
	}
	?>
	(incluye	IVA) que corresponde al {{$contrato->aporte}} % del costo total de la consultoría.

	@if ($contrato->aporte != 100) 
		Para completar el pago a {{$consultor->denominacion}}
		el aporte del empresario será de $ {{round($contrato->pagoEmpresario, 2)}} que es un {{(100 - $contrato->aporte)}}
		% de total de la consultoría.
	@endif

	No se reconocerá ninguna cantidad anticipadamente ni adicional. La forma de pago será: un solo
	pago al final de la asistencia técnica, siempre que el empresario firme el acta de conformidad de la
	asistencia técnica. No se reconocerá el pago a {{$consultor->denominacion}} si el empresario firma de rechazo en el acta de
	conformidad y justificando sus razones.


<br/>
	<p class="clausula">QUINTA: SELECCIÓN DE CONSULTOR </p>


	{{$empresario->nombre}}, manifiesta haber seleccionado a {{$consultor->nombre}}, del siguiente listado de consultores que presentaron ofertas a CDMYPE:
		<ol>
			@foreach($ofertantes as $ofertante)
				<li>
					{{$ofertante->consultor}}
				</li>
			@endforeach
		</ol>

	<p class="clausula"> SEXTA: ESTIPULACIONES ESPECIALES. </p>

		<ol>
			<li>
				<?php echo ucfirst($consultor->denominacion) ?> se obliga a guardar estricta confidencialidad sobre la información obtenida de la empresa y los resultados de los servicios que preste.
			</li>
			<li>
				<?php echo ucfirst($consultor->denominacion) ?> no podrá desarrollar más de 3 consultorías de manera simultánea.
			</li>
			<li>
				<?php echo ucfirst($consultor->denominacion) ?> se obliga entregar un informe final al empresario beneficiario.
			</li>
			<?php if ($at->aporte != 0) {
			echo "<li>
				El pago del aporte empresarial deberá ser realizado únicamente en las oficinas del CDMYPE o a
				través de depósito bancario, para que, luego de la firma del presente contrato, ";

			echo  $consultor->denominacion;
			echo " entregue al empresario factura o crédito fiscal correspondiente al monto pagado.</li>";
			}?>

			<li>
				Al finalizar la asistencia técnica, {{$consultor->denominacion}} presentará factura de consumidor final a nombre del
				CDMYPE-UNICAES, por la cantidad correspondiente al
				<?php if ($at->aporte != 0) {
					echo $contrato->aporte;
				}else{
					echo "100";
				}
				?>
				% del valor total de la consultoría
				<?php if ($at->aporte != 0) {
				echo ";
				anexado a dicho comprobante vendrá fotocopia de la factura o crédito fiscal emitida por ";
				echo $consultor->denominacion;
				echo " al	empresario beneficiado en concepto del ";
				echo (100 - $contrato->aporte);
				echo "% de aporte empresarial.";
				}else{
					echo ".";
				}
				?>

			</li>
			<li>
				Todos los precios detallados en el presente contrato, incluyen cualquier tipo de impuestos.
			</li>
		</ol>

	<p class="clausula">
		SEPTIMA: TERMINACIÓN.
	</p>
		El contrato podrá darse por terminado según las causas siguientes:
		<ol type="a">
			<li> Por común acuerdo entre las partes. </li>
			<li> Por solicitud de una de las partes, por motivo de fuerza mayor debidamente justificado y aceptado por la otra. </li>
			<li> Si cualquiera de las partes incumpliere cualquier obligación derivada del presente contrato. </li>
			<li> Por causas imprevistas que hicieren imposible obtener la consultoría contratada, dando aviso a la otra parte con quince días de anticipación a la fecha de suspensión del contrato. </li>
			<li> Por faltas a la ética profesional. </li>
		</ol>
		Cuando el contrato se dé por terminado por las razones descritas en los literales (b), (c) y (d) las cuales sean imputables a la(s) empresa(s) beneficiaria(s). El CDMYPE, a su discreción, podrá
		reconocer a {{$consultor->denominacion}} los gastos razonables que hubiere efectuado, siempre que éstos estén justificados
		y se compruebe en forma fehaciente que corresponden al objeto de este contrato.

<br/>
	<p class="clausula"> OCTAVA: OBLIGACIONES DEL EMPRESARIO. </p>
			<ol>
				@if($at->aporte != 0)
				<li>
					@if($empresario->sexo =='Mujer')
					La empresaria
					@else
					El empresario
					@endif
					deberá aportar la cantidad de USD $ <?php echo round($contrato->pago * ((100 - $contrato->aporte)/100), 2)?> dólares que corresponde al {{100 - $contrato->aporte}}% del monto
					total de la asistencia técnica y depositarlo en el Banco de América Central a la cuenta corriente
					No 200779726 a nombre de Universidad Católica de El Salvador Centro Regional Ilobasco o bien
					realizarlo directamente en las oficinas del CDMYPE.
				</li>
				@endif
				<li>
					Facilitar toda la información que sea necesaria para efecto del desarrollo de la asistencia técnica.
				</li>
				<li>
					Destinar el tiempo requerido para la ejecución de la asistencia técnica que {{$consultor->denominacion}} requiera para
					dar cumplimiento al plan de trabajo.
				</li>
				<li>
					Implementar las recomendaciones realizadas por {{$consultor->denominacion}} para el logro de los objetivos de la
					consultoría.
				</li>
				<li>
					Acceder a la realización de la encuesta de evaluación de impacto del o los servicios recibidos.
				</li>
				<li>
					Realizar la evaluación de desempeño de {{$consultor->denominacion}}.
				</li>
			</ol>

			<p class="clausula"> NOVENA: VIGENCIA, ORDEN DE INICIO Y PRÓRROGAS </p>


			Este contrato entrará en vigencia a partir de la fecha de su firma y a partir de la misma autoriza a
			{{$consultor->nombre}} a dar inicio a la asistencia técnica.
			<br>
			En fe de lo cual firmamos el presente contrato en original en {{$contrato->lugar_firma}} a los {{$dia}} días del mes
			de {{$mes}} del año {{$ano}}.
	</p>

	<div class="firmas">
			<br><br><br><br>
		<div class="firm apoderado">
			F._____________________	<br/>
			Lic. Roberto Antonio López <br/>
			Apoderado Especial Administrativo <br/>
			Universidad Católica de El Salvador
		</div>
		<div class="firm empresario">
			F._____________________	<br/>
			{{$empresario->nombre}} <br/>
			{{$empresario->empresa->nombre}}

		</div>
		<div class="firm consultor">
			F._____________________	<br/>
			{{$consultor->nombre}} <br/>
			{{$consultor->empresa}} <br/>
		</div>
	</div>
</div>
</body>
</html>






