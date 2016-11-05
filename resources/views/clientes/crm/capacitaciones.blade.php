<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingTwo">
    <a class="glyphicon glyphicon-plus l-agregar btn btn-primary pull-left"></a>
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#dos" aria-expanded="false" aria-controls="dos">
    <h4 class="panel-title">
        Capacitaciones
        <span class="glyphicon glyphicon-chevron-down pull-right"></span>
        <span class="pull-right">&nbsp;&nbsp;</span>
        <span class="pull-right badge alert-danger">{{ count($capacitaciones) }}</span>
    </h4>
    </a>
  </div>
  <div id="dos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr class="active">
                <th class="text-center">Fecha</th>
                <th class="text-center">Tema</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($capacitaciones as $capacitacion)
            <tr class="{{$capacitacion['asistio'] == 'Si'?'':'danger'}}">

                <td>{{ $capacitacion['fecha'] }}</td>
                <td>
                    <a href="{{route('capPaso', $capacitacion['id'])}}">{{ $capacitacion['tema'] }}
                    </a>
                </td>
                
            </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
