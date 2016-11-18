'use strict';

/* Directives */


angular.module('Directives', []).

directive('appVersion', ['version', function(version) {
return function(scope, elm, attrs) {
  elm.text(version);
};
}])

.directive('datetime', function() { 
	return { 
		restrict: 'A', 
		link: function(scope, element, attrs) 
		{ 
			$(element).datepicker({format: 'mm/dd/yyyy', startDate: '-3d'});
		}
	}
})

.directive('datepicker', function() { 
	return { 
		restrict: 'A', 
		link: function(scope, element, attrs) 
		{ 
			$(element).datepicker({format:'mm/dd/yyyy'});
		}
	}
})

.directive('previsualizar', [function () {
	return {
		restrict: 'A',
		link: function (scope, element, attrs) {
			$(element).click(function(e)
			{
			    $("#texto").val($(this).val());
			    $("#myModalBandera").val($(this).attr("name"));
			    var nombre = $('#myModalBandera').val();
			    $("#tituloModal").text($("label[for=" + nombre + "]").text());
			    $('#previsualizar').modal('show');
			});

		}
	};
}])

.directive('closeprevisualizar', [function () {
	return {
		restrict: 'A',
		link: function (scope, element, attrs) {
			$(element).click(function(e)
			{
			    var text = $("#texto").val();
			    var nombre = $('#myModalBandera').val();
			    $("textarea[name=" + nombre + "]").val(text);
			    $('#previsualizar').modal('hide')
			});

		}
	};
}])

.directive('toolbar',function(){
	return {
		restrict: "E",
		templateUrl: "app/views/partials/toolbar.html"
	}
})

.directive('opciones',function(){
	return {
		restrict: "E",
		templateUrl: "app/views/partials/opciones.html"
	}
})

.directive('ubicacion',function(){
	return {
		restrict: "E",
		scope: {
		    tabla: '=tabla'
		},
		templateUrl: "app/views/ubicacion.html"
	}
})

.directive('alertas',function(){
	return {
		restrict: "E",
		templateUrl: "app/views/partials/alertas.html"
	}
})

// Ventas
	.directive('venta',function(){
		return {
			restrict: "E",
			templateUrl: "app/views/sucursal/ventas/crear/venta.html"
		}
	})
	.directive('detalle',function(){
		return {
			restrict: "E",
			templateUrl: "app/views/sucursal/ventas/crear/detalle.html"
		}
	})
	.directive('listaventa',function(){
		return {
			restrict: "E",
			templateUrl: "app/views/sucursal/ventas/crear/listaventa.html"
		}
	})

// Compras
	.directive('compra',function(){
		return {
			restrict: "E",
			templateUrl: "app/views/farmacia/compras/crear/compra.html"
		}
	})
	.directive('detallecompra',function(){
		return {
			restrict: "E",
			templateUrl: "app/views/farmacia/compras/crear/detalle.html"
		}
	})
	.directive('listacompra',function(){
		return {
			restrict: "E",
			templateUrl: "app/views/farmacia/compras/crear/listacompra.html"
		}
	});