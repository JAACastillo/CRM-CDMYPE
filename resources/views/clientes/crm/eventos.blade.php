<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingThree">
        <a class="glyphicon glyphicon-plus l-agregar btn btn-primary pull-left"></a>
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#tres" aria-expanded="false" aria-controls="tres">
    <h4 class="panel-title">
        Eventos
        <span class="glyphicon glyphicon-chevron-down pull-right"></span>
        <span class="pull-right">&nbsp;&nbsp;</span>
        <span class="pull-right badge alert-danger">{{count($eventos)}}</span>
    </h4>
      </a>

  </div>
  <div id="tres" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr class="active">
                <th class="text-center">Fecha</th>
                <th>Tema</th>
                <th>Organizador</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($eventos as $evento)
            <tr>
              <td> {{$evento['fecha']}} </td>                
              <td> {{$evento['nombre']}} </td>                
              <td> {{$evento['tipo']}} </td>                
            </tr>
            @endforeach
            </tbody>
        </table>
      </div> 
    </div>
  </div>
</div>
