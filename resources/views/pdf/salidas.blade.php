<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
   <style>
        h3, h4 {margin: 5px;}
        p{margin: 5px;}
        #contenido {font-family: "arial black" ;text-align:justify; font-size: 13px; line-height: 15px}
        .titulo{text-align:center;}
        .asistencia {margin-top: 10px;}
        .table, th {border: 1px solid black; margin: 0px; padding: 5px; font-size: 10px;}
        .table>thead{background-color: gray; color:white;}
        .table, td {border: 1px solid black; margin: 0px; padding: 5px; font-size: 10px;}
        .datos {margin-left: 10px;}

        .firmas .firm { display: inline-block; position: absolute; text-align: center;}
        .director {float: right; margin-left: -750px}
        .decano {float: right; margin-left: 550; position: absolute;}

      </style>
    <?php
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    ?>
   <title>Formato Salidas</title>
</head>
<body>

<div class="titulo">
  <h3>CDMYPE UNICAES</h3>
  <h4>Solicitud de transporte para visitas a empresarios, seguimientos y otras actividades.</h4>
</div>

<div id="contenido">
   <div class="datos">
      <p><strong>GENERALIDADES:</strong></p>
      <span><strong>UNIDAD:</strong> Centro de Desarrollo de Micro y Pequeña Empresa</span>&nbsp;&nbsp;&nbsp;
      <span><strong>MES/AÑO: </strong>{{$meses[$mes-1]}} {{$ano}} </span>&nbsp;&nbsp;&nbsp;
      <span><strong>FECHA DE SOLICITUD: </strong>{{date('d/m/Y')}}</span>
   </div>
   <div class="asistencia">

      <table class="table">
         <thead>
            <tr>
               <th>FECHA</th>
               <th>HORARIO</th>
               <th>LUGAR A VISITAR</th>
              <th>No. PARTICIPANTES </th>
               <th>NOMBRES</th>
               <th>JUSTIFICACION DE LA ACTIVIDAD</th>
               <th>OBJETIVO DE LA ACTIVIDAD</th>
              <th>ASESOR RESPONSABLE</th>
              <th>ESTADO</th>
              <th>OBSERVACIONES</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($salidas as $salida)
            <tr>
              <td style="text-align: center;">
                {{date("d/m/Y", strtotime($salida->fecha_inicio)); }}
              </td>
              <td style="text-align: center;">
                {{date("g:i a", strtotime($salida->hora_salida));}}<br>{{date("g:i a", strtotime($salida->hora_regreso));}}
              </td>
              <td style="text-align: center;">
                {{$salida->municipio->municipio}}
              </td>
             <?php
		$participantes = Participante::where('salida_id', $salida->id)->get();
		
               ?>

             <td> {{ sizeof($participantes)  }}
              <td>
  
                @foreach ($participantes as $participante)
                    <span>{{$participante->participante->nombre}}</span><br>
                @endforeach
              </td>
              <td>{{$salida->justificacion}}</td>
              <td>{{$salida->objetivo}}</td>
              <td>{{$salida->responsable->nombre}}</td>
              <td>{{--- $salida->estado --}}</td>
              <td>{{$salida->observacion}}</td>
            </tr>
            @endforeach

         </tbody>
      </table>
   </div>
  <br><br><br><br><br>
  <div class="firmas">
    <div class="firm director">
      <p>F.____________________________</p>
      @if ($firma == 1)
        <p>Msc. Enrique Reyes Escobar</p>
        <p>Director CDMYPE UNICAES</p>
      @else
        <p>Msc. Yessenia Escobar de Hernández</p>
        <p>Directora CDMYPE UNICAES</p>
      @endif
    </div>
    <div class="firm decano">
      <p>F.____________________________</p>
        <p>Ing. Juan Alfonso Trigueros</p>
        <p>DECANO</p>
    </div>
  </div>
</div>
</body>
</html>
