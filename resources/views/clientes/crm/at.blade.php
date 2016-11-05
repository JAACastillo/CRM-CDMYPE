<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingThree">
        <a class="glyphicon glyphicon-plus l-agregar btn btn-primary pull-left"></a>
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#cuatro" aria-expanded="false" aria-controls="cuatro">
    <h4 class="panel-title">
        Asistencias técnicas
        <span class="glyphicon glyphicon-chevron-down pull-right"></span>
        <span class="pull-right">&nbsp;&nbsp;</span>
        <span class="pull-right badge alert-danger">{{$at->count()}}</span>
    </h4>
      </a>
  </div>
  <div id="cuatro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
    	<div class="table-responsive">
    	  <table class="table table-bordered">
    	      <thead>
    	      <tr class="active">
    	          <th>Tema</th>
    	          <th class="text-center">Estado</th>
    	      </tr>
    	      </thead>
    	      <tbody>
    	      @foreach ($at as $asistencia)
    	      <tr class="{{$asistencia->estado == 'Cancelada'?'danger':''}}">
    	          <td>
    	              <a href="{{route('atPaso', $asistencia->id)}}">{{ substr($asistencia->tema, 0, 80) }} ...
    	              </a>
    	          </td> 
    	          <td class="text-center">{{ $asistencia->estado }}</td>
    	          
    	      </tr>
    	      @endforeach
    	      </tbody>
    	  </table>
    	</div> 
    </div>
  </div>
</div>
