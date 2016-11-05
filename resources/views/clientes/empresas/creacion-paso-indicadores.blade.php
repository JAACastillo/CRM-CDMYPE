@extends('menu')

@section('escritorio')

@include('clientes.empresas/pasos')

<div>

<style type="text/css">
input[name="productos[]"]{
    margin-bottom:5px;
}
input[name="productos[0]"]{
    margin-bottom:5px;
}
</style>

@include('errores', array('errors' => $errors))
{{ Form::model($indicador, $accion) }}


    {{Form::hidden('empresa_id', null)}}
<div class="row animated fadeIn">
        @if(isset($imprimir))
            <div class="panel-heading">
                <a class="btn btn-default" href="{{route('f1PDF', $indicador->empresa_id)}}" data-toggle="tooltip" data-placement="bottom" title="Imprimir F1" target="_blank"> <span class="glyphicon glyphicon-print"></span>&nbsp F1</a>
            </div>
        @else 
        <br>
        @endif
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('fechaInicio', 'Fecha Inicio Operaciones:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                <input type="date" name="fechaInicio" class="form-control" data-date='{"startView": 2, "openOnFocus": true}' value="{{$indicador->fechaInicio}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('contabilidadFormal', 'Contabilidad Formal:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                                <input name="contabilidadFormal" type="checkbox"  value="1" {{($indicador->contabilidadFormal == 1?'checked':'')}}>
                            </div>
                        </div>
		                <div class="form-group">
		                    {{ Form::label('ventaNacional', 'Venta Nacional:', array('class' => 'control-label col-md-4')) }}
		                    <div class="col-md-5">
							    <div class="input-group">
							      <div class="input-group-addon">$</div>
		                        	{{ Form::number('ventaNacional', $indicador->ventaNacional, array('class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => 'any')) }}
		                    	</div>
		                    </div>
		                </div>
		                <div class="form-group">
		                    {{ Form::label('ventaExportacion', 'Venta de Exportación:', array('class' => 'control-label col-md-4')) }}
		                    <div class="col-md-5">
							    <div class="input-group">
							      <div class="input-group-addon">$</div>
		                        	{{ Form::number('ventaExportacion', $indicador->ventaExportacion, array('class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => 'any')) }}
		                    		
		                    	</div>
		                    </div>
		                </div>
                        <div class="form-group">
                            {{ Form::label('costoProduccion', 'Costo de Producción:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-5">
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                    {{ Form::number('costoProduccion', $indicador->costoProduccion, array('class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => 'any')) }}
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('financiamiento', 'Financiamiento:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-5">
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                    {{ Form::number('financiamiento', $indicador->financiamiento, array('class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => 'any')) }}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('capitalSemilla', 'Capital Semilla:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-5">
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                    {{ Form::number('capitalSemilla', $indicador->capitalSemilla, array('class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => 'any')) }}
                                    
                                </div>
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
                            {{ Form::label('empleadosHombreFijo', 'Empleados Hombre:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-5">
                                <div class="input-group">
                                  <div class="input-group-addon">#</div>
                                    {{ Form::number('empleadosHombreFijo', $indicador->empleadosHombreFijo, array('placeholder' => 'Fijos', 'class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => '1')) }}                                   
                                    {{ Form::number('empleadosHombreTemp', $indicador->empleadosHombreTemp, array('placeholder' => 'Temporales', 'class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => '1')) }}
                                </div>
                            </div>
                        </div>                    
                        <div class="form-group">
                            {{ Form::label('empleadosMujerFijo', 'Empleadas:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-addon">#</div>
                                    {{ Form::number('empleadosMujerFijo', $indicador->empleadosMujerFijo, array('placeholder' => 'Fijos', 'class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => '1')) }}
                                    {{ Form::number('empleadosMujerTemp', $indicador->empleadosMujerTemp, array('placeholder' => 'Temporales', 'class' => 'form-control text-center', 'min' => '1', 'max' => '1000000', 'step' => '1')) }}
                                </div>
                            </div>
                        </div>                        
                        <div class="form-group"> 
                            {{ Form::label('mercados', 'Mercados Actuales:', array('class' => 'control-label col-md-4')) }}
                            <div class="col-md-8">
                            {{ Form::select('mercados[]', $mercados, $indicador->merca, array('class' => 'chosen-select form-control ', 'multiple' => 'true', 'data-placeholder' => '  Mercados Actuales' )) }}
                            </div>
                        </div>                    
                        <div class="form-group">
                            {{ Form::label('productos', 'Productos:', array('class' => 'control-label col-md-4')) }} 
                            <div class="col-md-6 productos">
                            {{ Form::text('productos[0]', null,  array('class' => 'form-control ', 'placeholder' => 'Nombre del producto' )) }}

                            @foreach($indicador->productos as $producto)
                                {{ Form::text('productos[]', $producto->nombre,  array('class' => 'form-control ', 'placeholder' => 'Nombre del producto' )) }}
                            @endforeach
                            </ul>
                            </div>
                            <div class="col-md-2">
                            <a id="addProducto" class="btn btn-primary pull-left"> + </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>


<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <center>
                        <a href="javascript:history.back()">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                         Anterior
                        </a>
                        </center>
                    </div>
                    <div class="col-xs-6">
                        <center>
                        <button type="submit" tabindex="11" class="btn btn-primary ladda-button" data-style="expand-right">
                        Siguiente
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                        </button>
                        </center>
                    </div>          
            </div>
        </div>
    </div>
</div>


{{Form::close()}}
@stop


@section('script')

<script type="text/javascript">
	
    $('.busqueda').on('click', function(){
    	$('.buscar').toggle("blind");
    	$('#empresario').toggle("blind")	
    })
var num = 1;
    $('#addProducto').on('click', function(){
        var caja = "<input type='text' style='margin-bottom:5px' class='form-control' name='productos[" + num +  "]' placeholder='Nombre del producto' >"
        $('.productos').prepend(caja)
        num++;
    })

</script>
@include('validaciones.indicadores')
@stop