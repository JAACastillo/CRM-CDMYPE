<!-- Datos Cliente -->
<div class="row">
  <div class="col-md-12">
    <div class="page-header">
      <a href="{{route('pasoEmpresarios', $empresa->id)}}" class="glyphicon glyphicon-eye-open agregar btn btn-primary pull-left"></a>
        <h2>Detalle de Cliente</h2>
    </div>
  </div>
</div>
<div class="row">
   <div class="col-md-6">
      <div class="dl-horizontal">
        <div class="form-group">
            <dt class="text-left">{{ Form::label('nombre', 'Nombre:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->nombre}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('sexo', 'Sexo:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->sexo}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('nit', 'NIT:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->nit}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('dui', 'DUI:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->dui}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('municipio_id', 'Municipio:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->municipio->municipio}}</p></dd>
        </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="dl-horizontal">
        <div class="form-group">
            <dt class="text-left">{{ Form::label('direccion', 'Dirección:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->direccion}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('correo', 'Correo Eléctronico:', array('class' => 'control-label')) }}</dt>
               <dd><p>{{$empresario->correo}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('telefono', 'Teléfono:', array('class' => 'control-label')) }}</dt>

                <dd><p>{{$empresario->telefono}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('celular', 'Celular:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresario->celular}}</p></dd>
        </div>
      </div>
   </div>
</div>
