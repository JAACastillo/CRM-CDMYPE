
<div class="panel panel-default" style="margin-bottom: 5px;">
  <div class="panel-heading" role="tab" id="headingOne">
    <a class="glyphicon glyphicon-plus l-agregar btn btn-primary pull-left"></a>
    <a data-toggle="collapse" data-parent="#accordion" href="#uno" aria-expanded="true" aria-controls="uno">
    <h4 class="panel-title">
        Proyectos Trabajados
        <span class="glyphicon glyphicon-chevron-down pull-right"></span>
        <span class="pull-right">&nbsp;&nbsp;</span>
        <span class="pull-right badge alert-danger">{{ $proyectos->count()}}</span>
    </h4>
  </a>
  </div>
  <div id="uno" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="active">
                <th class="text-center">Nombre</th>
                <th class="text-center">Asesor</th>
                <th class="text-center">Inicio</th>
                <th class="text-center">Fin</th>
                <th class="text-center">%</th>
                <th class="text-center">Opciones</th>
            </tr>

            @foreach ($proyectos as $proyecto)
            <tr>
                <td>
                    <a href="{{route('empresaPasoSeguimientoProyecto', $proyecto->id)}}">
                    {{ $proyecto->nombre }}
                    </a>
                </td>
                <td>
                    {{$proyecto->encargado->nombre}}
                </td>
                <?php
                    $avance = $proyecto->avance ;
                ?>
                <td class="text-center">{{ $proyecto->fechaInicio }}</td>
                <td class="text-center">{{ $proyecto->fechaFin }}</td>
                <td class="text-center">{{ round($avance)}} %</td>
                <td class="text-center">
                  <a href="{{route('empresaF2', $proyecto->id)}}" target="_blank" class="btn btn-default btn-xs"> F2</a>
                    @if($avance == '0')
                        <a href="{{ route('empresaPasoProyectoEditar', $proyecto->id) }}" class="btn btn-default btn-xs glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="left" title="Editar"> </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
