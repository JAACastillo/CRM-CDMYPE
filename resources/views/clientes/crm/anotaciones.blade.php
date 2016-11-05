<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingThree">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#cinco" aria-expanded="false" aria-controls="cinco">
    <h4 class="panel-title">
        Anotaciones
        <span class="pull-right badge alert-danger">{{ $anotaciones->count() }}</span>
    </h4>
    </a>
  </div>
  <div id="cinco" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
      <a class="l-agregar btn btn-primary pull-left" id="cambiar">
        <span class="glyphicon glyphicon-plus visible"></span>
        <span class="glyphicon glyphicon-chevron-left oculto"></span>
      </a>
        <div class="row visible">
          <div class="col-md-12">
            <!-- Notas -->
            @foreach ($anotaciones as $nota)
              <blockquote class="alert-primary">
                <h4>{{ $nota->usuario->nombre }} &nbsp;<small>{{ date("d-m-Y", strtotime($nota->created_at)); }}</small></h4>
                <p class="text-justify animated fadeIn nota">
                  {{ $nota->nota }}
                </p>
              </blockquote>
            @endforeach
            <!--  -->
          </div>
        </div>
        <!-- Formulario Para Ingresar Notas -->
        <div class="row oculto">
          {{ Form::model($anotacion, array('route' => 'anotaciones', 'method' => 'POST','role' => 'form')) }}
          <div class="col-md-12">
            <br>
            <div class="form-group">
              {{ Form::textarea('nota', null, array('placeholder' => 'Descripción de la Empresa', 'rows' => '6', 'class' => 'form-control', 'required')) }}
              {{ Form::hidden('empresa_id', $empresa->id) }}
            </div>
            <center>
              <br>
              <div class="form-group">
                <button type="submit" tabindex="11" class="btn btn-primary ladda-button" data-style="expand-right">
                  Guardar
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  </span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                  </button>
              </div>
            </center>
          </div>
          {{Form::close()}}
        </div>
        <!--  -->
    </div>
  </div>
</div>

@section('script')

  <script type="text/javascript">
  $('#cambiar').on('click', function(){
    $('.oculto').toggle('fade');
    $('.visible').toggle('fade')
  });

</script>
@stop
