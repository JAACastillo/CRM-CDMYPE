
<!-- Datos Empresa -->
<div class="row">
<div class="col-md-12">
    <div class="page-header">
      <a href="#" class="glyphicon glyphicon-pencil agregar btn btn-primary pull-left"></a>
        <h2>Detalle de Empresa</h2>
           <span id="lb_seguimiento"class="pull-right hidden-xs"><strong>Ultimo Seguimiento:</strong> 22-Marzo-2014</span>
    </div>
</div>
</div>
<div class="row">
   <div class="col-md-6">
      <div class="dl-horizontal">
        <div class="form-group">
            <dt class="text-left">{{ Form::label('nombre', 'Nombre:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->nombre}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('categoria', 'Categoria:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->categoria}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('municipio', 'Municipio:', array('class' => 'control-label')) }}</dt>
                <dd><p> {{$empresa->municipio->municipio}} </p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('registro_iva', 'Registro de Iva:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->registro_iva}}<p/></dd>
        </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="dl-horizontal">
        <div class="form-group">
            <dt class="text-left">{{ Form::label('constitucion', 'Constitución:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->constitucion}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('clasificacion', 'Clasificación:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->clasificacion}}</p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('sector_economico', 'Sector Económico:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->sector_economico}}<p></dd>
        </div>
        <div class="form-group">
            <dt class="text-left">{{ Form::label('actividad', 'Actividad Económica:', array('class' => 'control-label')) }}</dt>
                <dd><p>{{$empresa->actividad}}<p></dd>
        </div>
      </div>
   </div>
</div>






