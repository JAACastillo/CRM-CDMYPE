<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                        <div class="col-md-8">
                            <select name="sexo" id="">
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                            </select> 
                        </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('nit', 'NIT:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::text('nit', null, array('placeholder' => 'XXXX-XXXXXX-XXX-X', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('dui', 'DUI:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::text('dui', null, array('placeholder' => 'XXXXXXXX-X', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                        {{ Form::label('departamento', 'Departamento:', array('class' => 'control-label col-md-4')) }}
                        <div class="col-md-8">
                            {{ Form::select('departamento', $departamentos, null, array('class' => 'form-control select1')) }} 
                        </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('municipio_id', 'Municipio:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::select('municipio_id',$municipios, null, array('class' => 'form-control select2')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('direccion', 'Dirección:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::textarea('direccion', null, array('placeholder' => 'Dirección', 'rows' => '2', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                             {{ Form::label('correo', 'Correo Electrónico:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::email('correo', null, array('placeholder' => 'ejemplo@ejemplo.com', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                             {{ Form::label('telefono', 'Teléfono:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::text('telefono', null, array('placeholder' => 'XXXX-XXXX', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('celular', 'Celular:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                {{ Form::text('celular', null, array('placeholder' => 'XXXX-XXXX', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>