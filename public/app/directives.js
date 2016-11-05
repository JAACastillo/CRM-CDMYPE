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

// .directive('datatable', function() { 
// 	return { 
// 		restrict: 'A', 
// 		link: function(scope, element, attrs) 
// 		{ 
// 			// $(element).DataTable();
// 			var table = $(element).DataTable( {
// 	            "language": {"sProcessing":     "Procesando...", "sLengthMenu":     "Mostrar _MENU_ registros", "sZeroRecords":    "No se encontraron resultados", "sEmptyTable":     "Ningún dato disponible en esta tabla", "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", "sInfoPostFix":    "", "sSearch":         "Buscar:", "sUrl":            "", "sInfoThousands":  ",", "sLoadingRecords": "Cargando...", "oPaginate": {"sFirst":    "Primero", "sLast":     "Ãšltimo", "sNext":     "Siguiente", "sPrevious": "Anterior"}, "oAria": {"sSortAscending":  ": Activar para ordenar la columna de manera ascendente", "sSortDescending": ": Activar para ordenar la columna de manera descendente"} 
// 	            },
// 	            dom: 'Bfrtip',
// 	            buttons: [
// 	                {
// 	                    extend: 'print', text: 'Print all'
// 	                },
// 	                {
// 	                    extend: 'print', text: 'Print selected', exportOptions: {modifier: {selected: true } }
// 	                },
// 	                'copyHtml5', 'excelHtml5', 'pdfHtml5'
// 	            ],
// 		            select: true
//         	});
// 			$('#length').on( 'change', function (e) {table.page.len( this.value ).draw(); } );
// 			$('#search').on( 'keyup', function () {table.search( this.value ).draw(); } );
// 			$('#print').on( 'click', function () {table.button( '0' ).trigger(); } );
// 			$('#print_all').on( 'click', function () {table.button( '1' ).trigger(); } );
// 			$('#copy').on( 'click', function () {table.button( '2' ).trigger(); } );
// 			$('#excel').on( 'click', function () {table.button( '3' ).trigger(); } );
// 			$('#pdf').on( 'click', function () {table.button( '4' ).trigger(); } );
// 		}
// 	}
// })

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