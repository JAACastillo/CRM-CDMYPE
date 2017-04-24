'use strict';

angular.module('Services', ['datatables'])

.factory('DT', function (DTOptionsBuilder) {
	var dtOptions = {};
	
	function get(){
		dtOptions = DTOptionsBuilder.newOptions() 
			.withPaginationType('full_numbers') 
			.withDisplayLength(10)
			.withButtons([{extend: 'copy', exportOptions: {columns: [1,2,3,4,5] } },{extend: 'print', exportOptions: {columns: [1,2,3,4,5] } }, {extend: 'excel', exportOptions: {columns: [1,2,3,4,5] } }])
			.withLanguage({"sEmptyTable":     "No data available in table", "sInfo":           "Mostrando _END_ registros de _TOTAL_", "sInfoEmpty":      "Mostrando _END_ de 0 registros", "sInfoFiltered":   "(filtered from _MAX_ total registros)", "sInfoPostFix":    "", "sInfoThousands":  ",", "sLengthMenu":     "Mostrar _MENU_ registros", "sLoadingRecords": "Loading...", "sProcessing":     "Processing...", "sSearch":         "", "sZeroRecords":    "No se encontraron registros", "oPaginate": {"sFirst":    "Primero", "sLast":     "Ultimo", "sNext":     "Siguiente", "sPrevious": "Anterior"}, "oAria": {"sSortAscending":  ": activate to sort column ascending", "sSortDescending": ": activate to sort column descending"} });
		return dtOptions;
	}
	return {get: get, };
})

.factory('Api', function ($http, $q){

// Direccion donde se piden los datos
	var base = "http://localhost:8000/api/";

    function get(url){
		var defer = $q.defer();
        var promise = defer.promise;

        // $http.get(base + url, { cache: true})
		$http.get(base + url)
        .success(function (data){
            defer.resolve(data); console.log(data);
        }) 
        .error(function (err){
            defer.reject(err); console.log(err); $.growl('No hay conexión al servidor', {type: 'warning'});
        })
        // .notify(function (data){
        //     $.growl('Cargando...', {type: 'info'});
        // })
        ;
		
        return promise; 
	}

	function post(url, data){
		var defer = $q.defer();
        var promise = defer.promise;

		$http.post(base + url, data)
        .success(function (data, code){if(code==201) defer.resolve(data); else defer.reject(data); })
        .error( function (data){console.log(data); $.growl('No hay conexión al servidor', {type: 'warning'}); defer.reject(data); })
		
        return promise;
	}
	return {
		get		: get,
		post	: post
	}
})

.factory('Dateme', function(){
	var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

	function get(){var date = yyyy+'-'+mm+'-'+dd; return date; }
	function mes(){return mm; }
	function ano(){return yyyy; }

	return {
		get		: get,
		mes		: mes,
		ano		: ano
	}

});

// .factory('Library', function (Api){

//     function guardar(url, data){
// 		$.growl('Guardando...', {type: 'info'});
// 		Api.post(url, data).then(function(data){
// 			$.growl('Proceso Exitoso', {type: 'success'});
// 		},
// 			function (data){
// 				$.growl('Error: ' + data, {type: 'warning'});
// 			}
// 		);
// 		return true;
// 	}
// 	function eliminar(url, data){
// 		$.growl('Eliminando...', {type: 'info'});
// 		Api.post(url, data).then(function(data){
// 			$.growl('Proceso Exitoso', {type: 'success'});
// 		},
// 			function (data){
// 				$.growl('Error: ' + data, {type: 'warning'});
// 			}
// 		);
// 		return true;
// 	}

// 	return {
// 		guardar		: guardar,
// 		eliminar	: eliminar
// 	}

// });
