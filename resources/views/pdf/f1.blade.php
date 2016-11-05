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
	     p {margin: 0px; padding: 5px}
	      .firmas {text-align: center;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .empresario {left: 40%}
	     .consultor {right: 0}
	     .cafe {background-color: #E0EAF1;}
	   </style>

	<title>Formulario F1</title>
</head>
<body>

<div id="header" >
	<img src="assets/img/cdmype-logo.jpg" width="150px" />
</div>

<div id="footer">
	<img src="assets/img/conamype-logo.jpg" width="150px" class="left" />

	<img src="assets/img/unicaes-logo.jpg" width="75px" class="right" />

</div>


<h4 class="titulo">
		Centro de desarrollo de Micro y Pequeñas Empresas (CDMYPE) <br>
		SOLICITUD DE ASESORAMIENTO
</h4>

<div id="contenido">
	<div class="datos">
		<p> Nombre del Asesor: ___________________________________________ Fecha:____/_____/______ </p>
	</div>
 
	<div class="tabla">
		<p class="cafe"> PARTE 1 / PROCEDENCIA DEL CLIENTE</p>
		<table style="width:100%"> 
			<tbody>
				<tr>
					<td witdh='50%'>	Centro Regional de CONAMYPE </td>
					<td witdh='50%'>	Promoción del CDMYPE </td>				
				</tr>
				<tr>
					<td>	Proyecto Específico </td>
					<td>	Iniciativa del cliente </td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="tabla">
		<p class="cafe"> PARTE 2 / INFORMACIÓN DEL SOLICITANTE</p>
		<table style="width:100%"> 
			<tbody>
				<tr>
					<td witdh='100%' colspan="2"> Nombre: <strong>{{$empresario->nombre}} </strong></td>
				</tr>
				<tr>
					<td witdh='50%'> DUI: <strong>{{$empresario->dui }}</strong></td>
					<td witdh='50%'> NIT: <strong>{{$empresario->nit }}</strong></td>
				</tr>
				<tr>
					<td witdh='50%'> Teléfono Empresa: <strong>{{$empresario->telefono }}</strong></td>
					<td witdh='50%'> Teléfono: <strong>{{$empresario->celular }}</strong></td>
				</tr>
				<tr>
					<td witdh='100%'  colspan="2"> Dirección: <strong>{{$empresario->direccion}} </strong></td>
				</tr>
				<tr>
					<td witdh='50%'> Municipio: <strong>{{$empresario->municipio->municipio }}</strong></td>
					<td witdh='50%'> Departamento: <strong>{{$empresario->municipio->departamento->departamento }}</strong></td>
				</tr>
				<tr>
					<td witdh='100%'  colspan="2"> Dirección de email: <strong>{{$empresario->correo}} </strong></td>
				</tr>
				<tr>
					<td witdh='100%'  colspan="2">Posición en la empresa: <strong>Propietario </strong></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="tabla">
		<p class="cafe"> PARTE 3 / INFORMACIÓN DE LA EMPRESA (USO EXCLUSIVO CDMYPE)</p>
		<table style="width:100%"> 
			<tbody>
				<tr>
					<td witdh='100%' colspan="4"> Nombre de la empresa, razón social o nombre comercial: <strong>{{$empresa->nombre}} </strong></td>
				</tr>
				<tr>
					<td witdh='50%' colspan="2"> NIT empresa: <strong>{{$empresa->nit }}</strong></td>
					<td witdh='50%' colspan="2"> No. IVA: <strong>{{$empresa->registro_iva}}</strong></td>
				</tr>
				<tr>
					<td witdh='100%'  colspan="4"> Constitución: <strong>{{$empresa->constitucion}} </strong></td>
				</tr>
				<tr>
					<td witdh='100%'  colspan="4"> Dirección: <strong>{{$empresa->direccion}} </strong></td>
				</tr>
				<tr>
					<td witdh='50%' colspan="2" > Municipio: <strong>{{$empresa->municipio->municipio }}</strong></td>
					<td witdh='50%'colspan="2" > Departamento: <strong>{{$empresa->municipio->departamento->departamento }}</strong></td>
				</tr>
				<tr>
					<td witdh='50%' colspan="2"> Género del propietario/a: <strong>{{$empresario->sexo }}</strong></td>
					<td witdh='50%' colspan="2"> Fecha de inicio de operaciones: <strong>{{ date("d-m-Y",strtotime($indicador->fechaInicio));}} </strong></td>
				</tr>
				<tr>
					<td witdh='100%'  colspan="4"> Lleva contabilidad formal: <strong>{{($indicador->contabilidadFormal?'Si':'No')}} </strong></td>
				</tr>
				<tr>
					<td witdh='50%'  colspan="2" class="cafe"> Sector económico:</td>
					 <td width="50%" colspan="2"> <strong>{{$empresa->sector_economico}} </strong></td>
				</tr>
				<tr >
					<td  width="20%" class="cafe"> Ventas últimos 12 meses </td>
					<td width="30%">
						<table border="none" class="tabla ">
							<tr>
								<td width="40%"> Mercado </td>
								<td width="60%"> Monto US$ </td>
							</tr>
							<tr>
								<td width="40%"> Nacional </td>
								<td width="60%"> $ {{$indicador->ventaNacional}} </td>
							</tr>
							<tr>
								<td width="40%"> Exportación </td>
								<td width="60%"> $ {{$indicador->ventaExportacion}} </td>
							</tr>
							<tr>
								<td width="40%"> TOTAL </td>
								<td width="60%"> $ {{$indicador->ventaExportacion + $indicador->ventaNacional}} </td>
							</tr>
						</table>
					</td>
					<td  width="15%" style="text-align:center" class="cafe"> Información de empleo </td>
					<td width="45%">
						<table border="none" class="tabla" style="margin:0px; padding:0px">
							<tr style="margin:0px; padding:0px">
								<td width="35%"> Empleos Actuales </td>
								<td width="25%"> Fijos </td>
								<td width="40%"> Temporales </td>
							</tr>
							<tr>
								<td width="35%"> Hombres </td>
								<td width="25%"> {{$indicador->empleadosHombreFijo}} </td>
								<td width="40%"> {{$indicador->empleadosHombreTemp}} </td>
							</tr>
							<tr>
								<td width="35%"> Mujeres </td>
								<td width="25%"> {{$indicador->empleadosMujerFijo}} </td>
								<td width="40%"> {{$indicador->empleadosMujerTemp}} </td>
							</tr>
							<tr>
								<td width="35%"> TOTAL </td>
								<td width="25%"> {{$indicador->empleadosMujerFijo + $indicador->empleadosHombreFijo}} </td>
								<td width="40%"> {{$indicador->empleadosMujerTemp + $indicador->empleadosHombreTemp}} </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4">Tamaño de la empresa: <strong> {{$empresa->clasificacion}} </strong></td>
				</tr>

				<tr>
					<td width="10%" class="cafe"> Otros </td>
					<td width="25%">
						<table border="none">
							<tr>
								<td> Costo Producción</td>
								<td> $ {{$indicador->costoProduccion}}</td>
							</tr>
							<tr>
								<td> Financiamiento actual</td>
								<td> $ {{$indicador->financiamiento}}</td>
							</tr>
							<tr>
								<td> Capital semilla</td>
								<td> $ {{$indicador->capitalSemilla}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table border="none">
							<tr>
								<td rowspan="4" class="cafe"> Mercados Actuales</td>
							
								<td> Local: </td>
								<td>
									<?php 
										echo ((in_array("Local", $mercados)?'X':''));
									?>
								</td>
							</tr>
							<tr>
								<td> Regional: </td>
								<td>
									<?php 
										echo ((in_array("Regional", $mercados)?'X':''));
									?>
								</td>
							</tr>
							<tr>
								<td> Nacional: </td>
								<td>
									<?php 
										echo ((in_array("Nacional", $mercados)?'X':''));
									?>
								</td>
							</tr>
							<tr>
								<td> Internacional: </td>
								<td>
									<?php 
										echo ((in_array("Internacional", $mercados)?'X':''));
									?>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table border="none">
							<tr>
								<td rowspan="{{$indicador->productos()->count() + 1}}" class="cafe">
									Principales productos
								</td>
								@foreach($indicador->productos as $producto)
									<tr>
										<td>
										{{$producto->nombre}}
										</td>
									</tr>
								@endforeach
							</tr>
						</table>

					</td>
				</tr>

			</tbody>
		</table>
		<p style="font-size:11px;">
			Declaro bajo juramento que la información proporcionada es verídica. Solicito asesoramiento al CDMYPE
			y estoy de acuerdo en participar si soy seleccionado para evaluar los servicios de asesoría recibidos
			del CDMYPE. Autorizo a CDMYPE para brindar mi nombre y domicilio para las encuestas de CONAMYPE, entiendo
			que la información proporcionada será tratada en forma confidencial. Autorizo a CDMYPE para proporcionar
			la información relevante al asesor asignado. Entiendo que el asesor se compromete a no recomendar servicios
			o bienes en los que tenga interés personal y a no aceptar comisiones o pagos por el asesoramiento.
		</p>

	<div class="firmas">
			<br><br><br>
		<div class="firm apoderado">
			F._____________________	<br/>
				Cliente
		</div>
		<div class="firm empresario">
			F._____________________	<br/>
				Asesor/a CDMYPE
		</div>
		<div class="firm consultor">
			F._____________________	<br/>
				Director/a CDMYPE
		</div>
	</div>
	</div>
	
</div>
</body>
</html>






