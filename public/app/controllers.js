'use strict';

angular.module('Controllers', [])

.controller('HeaderCtrl', function ($scope, DT) {

	// Manejar el titulo
		$scope.$on('Titulo', function (event, args) {$scope.titulo = args.titulo; $scope.subtitulo = args.subtitulo; });
		$scope.triggerbtn = function(dtInstancia, btn) {dtInstancia.DataTable.button(btn).trigger(); };
		$scope.buscar = function(dtInstancia, query) {dtInstancia.DataTable.search(query).draw(); };
		$scope.show = function(num) {$scope.dtOptions.iDisplayLength = num; };
		$scope.dtOptions = DT.get();

})

.controller('DashCtrl', function (Api, $scope,$timeout, $log, $modal) {

	$scope.$emit('Titulo', { titulo: "Dashboard", subtitulo: "Panel de control" });
	// Cargar datos

		$scope.cargar = function (valor) {
			$scope.dash = [];
			// $scope.atterminos_labels = [];
			// $scope.atterminos_data = [];
			// $scope.ventas_labels = [];
			// $scope.ventas_data = [];

		    Api.get('dash/dia').then(function(data){ 
		    	$scope.dash = data;
		    	console.log(data);
		  //   	for (var i in $scope.dash.tipoproducto ) {
				// 	$scope.atterminos_labels.push($scope.dash.tipoproducto[i].producto.nombre);
		  //   		$scope.atterminos_data.push($scope.dash.tipoproducto[i].total);
				// }
				// console.log($scope.dash.ventas);
				// for (var i in $scope.dash.ventas) {
				// 	$scope.ventas_labels.push($scope.dash.ventas[i].mes);
		  //   		$scope.ventas_data.push($scope.dash.ventas[i].num);
				// }
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
		};

		// $scope.atterminos_opt = {
		// 	responsive: true,
		// 		legend: {display: true, position: 'left', labels:{fontSize: 11 }
		// }};

	 //    $scope.type = 'doughnut';

	 //    $scope.toggle = function () {
	 //      $scope.type = $scope.type === 'pie' ? 'doughnut' : 'pie';
	 //    };

})

// Clientes

	// Empresarios
	.controller('EmpresariosCtrl', function (Api, $scope, $location, $modal) {
		
		$scope.$emit('Titulo', { titulo: 'Empresarios', subtitulo:'Listado' });
		$scope.empresarios = [];
		$scope.dtInstancia = {};

		$scope.cargar = function () {
		    Api.get('empresarios').then(function(data){ $scope.empresarios = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		};

		$scope.crear = function(){ $location.path('/clientes/empresario/nuevo') };

		$scope.actualizar = function(empresario){ $location.path('/clientes/empresario/' + empresario.id); };

		// Eliminar
		$scope.eliminar = function(empresario){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('empresario/eliminar/'+ empresario.id).then(function(data){
					$.growl('Eliminado', {type: 'success'});
					for (var i in $scope.empresarios ) {
						if ($scope.empresarios[i].id === data.id ){
							$scope.empresarios.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};

	})
	// Empresas
	.controller('EmpresasCtrl', function (Api, $scope, $location, $modal) {
		
		$scope.$emit('Titulo', { titulo: 'Empresas', subtitulo:'Listado' });
		$scope.empresas = [];
		$scope.dtInstancia = {};

		$scope.cargar = function () {
		    Api.get('empresas').then(function(data){ $scope.empresas = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		};

		$scope.crear = function(){ $location.path('clientes/empresario/nuevo') };

		$scope.actualizar = function(empresa){ $location.path('clientes/empresario/empresa/' + empresa.id); };

		// Eliminar
		$scope.eliminar = function(empresa){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('empresa/eliminar/'+ empresa.id).then(function(data){
					$.growl('Eliminado', {type: 'success'});
					for (var i in $scope.empresas ) {
						if ($scope.empresas[i].id === data.id ){
							$scope.empresas.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};

	})

	// Paso 1
	.controller('EmpresarioCtrl', function (Api, $location, $routeParams, $scope, $modal) {
		$scope.pasoActual = 1;
		$scope.empresa = {};
		// Verificar si si creara o editara
			if ($routeParams.id>0) {
				    Api.get('empresario/'+ $routeParams.id).then(function(data){ 
				    	$scope.empresario = data;
				    	if ($scope.empresa.id) {data.empresa.empresa_id;}
				    	$scope.$emit('Titulo', { titulo: $scope.empresario.nombre, subtitulo: "Edición" });
				    	$scope.pasoReal = data.paso;
				    	if (data.paso == 2) {$scope.empresario_id = 0;}
				    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 
			}else{
				$scope.$emit('Titulo', { titulo: 'Empresario', subtitulo: 'Nuevo' });
				$scope.empresario = {};
				$scope.pasoReal = 1;
			}


	 		$scope.Ok = function(empresario){
	 			if (!frm.$invalid) {
		  			Api.post('empresario/guardar', empresario).then(function(data){
						$.growl('Guardado', {type: 'success'});
						$location.path('/clientes/empresario/' + data.id);
					} ,function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					});
		  	 	}
		  	};
	})

	// Paso 2
	.controller('EmpresarioEmpresaCtrl', function (Api, $location, $routeParams, $scope, $modal) {

		$scope.pasoActual = 2;
		$scope.empresario = {};
		// Verificar si si creara o editara
		if ($routeParams.id>0) {
			Api.get('empresa/'+ $routeParams.id).then(function(data){ 
				$scope.empresa = data;
				$scope.empresario.id = data.empresario.empresario_id;
		    	$scope.pasoReal = data.paso;
				$scope.empresa.tipo = data.empresario.tipo;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		}else{
			$scope.$emit('Titulo', { titulo: 'Empresario', subtitulo: 'Nuevo' });
			$scope.empresario = {};
			$scope.pasoReal = 1;
		}
			
			$scope.Ok = function(empresa){
	 			if (!frmempresa.$invalid) {
	 				console.log(empresa);
		  			Api.post('empresa/guardar', empresa).then(function(data){
						var empresarioEmpresa = {};
	 					empresarioEmpresa.tipo = empresa.tipo;
						empresarioEmpresa.empresario_id = $scope.empresario.id;
	 					empresarioEmpresa.empresa_id = data.id;

		  				console.log(empresarioEmpresa);
			  			Api.post('empresario/empresa', empresarioEmpresa).then(function(data){
							$.growl('Guardado', {type: 'success'});
							$location.path('/clientes/empresario/empresa/indicadores' + $scope.empresario.id);
							}, function (data){
							$.growl('No se pudo guardar', {type: 'warning'});
						});

					}, function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					});

	 				
		  	 	}
		  	};

	})

	// Paso 3
	.controller('EmpresaIndicadoresCtrl', function (Api, $scope, $routeParams, $location, $modal) {
		
		$scope.pasoActual = 3;
		$scope.empresario = {};
		// Verificar si si creara o editara
			Api.get('empresa/indicadores/'+ $routeParams.id).then(function(data){ 
				$scope.empresa = data;
				$scope.empresario.id = data.empresario.empresario_id;
		    	$scope.pasoReal = data.paso;

		    	if (data.indicadores == ""){
					$scope.indicadores = {};
		    	}
				else{
					console.log(data);
					$scope.indicadores = data.indicadores;	    	
				}

				$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });

		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	 		$scope.Ok = function(empresario){
	 			if (!frm.$invalid) {
		  			Api.post('empresario/guardar', empresario).then(function(data){
						$.growl('Guardado', {type: 'success'});
						$location.path('/clientes/empresario/empresa/' + data.id);
					} ,function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					});
		  	 	}
		  	};

	})

	// Paso 4
	.controller('EmpresaHistorialCtrl', function (Api, $scope, $routeParams, $location, $modal) {
		
		$scope.pasoActual = 4;
		$scope.empresario = {};
		// Verificar si si creara o editara
			Api.get('empresa/historial/'+ $routeParams.id).then(function(data){ 
				$scope.empresa = data;
				$scope.empresario.id = data.empresario.empresario_id;
				$scope.pasoReal = data.paso;
				console.log(data);
				$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });

		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	})


// Consultores
	
	.controller('ConsultoresCtrl', function (Api, $scope, $location, $modal) {
		
		$scope.$emit('Titulo', { titulo: 'Consultores', subtitulo:'Listado' });
		$scope.consultores = [];
		$scope.dtInstancia = {};

		$scope.cargar = function () {
		    Api.get('consultores').then(function(data){ $scope.consultores = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		};

		$scope.crear = function(){ $location.path('/consultor/nuevo') };

		$scope.actualizar = function(consultor){ $location.path('/consultor/' + consultor.id); };

		// Eliminar
		$scope.eliminar = function(consultor){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('consultor/eliminar/'+ consultor.id).then(function(data){
					$.growl('Eliminado', {type: 'success'});
					for (var i in $scope.consultores ) {
						if ($scope.consultores[i].id === data.id ){
							$scope.consultores.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};

	})
	// Paso 1
	.controller('ConsultorCtrl', function (Api,$log, $routeParams, $scope, $modal) {
		$scope.pasoActual = 1;
		// Verificar si si creara o editara
			if ($routeParams.id>0) {
				    Api.get('consultor/'+ $routeParams.id).then(function(data){ 
				    	$scope.consultor = data;
				    	$scope.pasoReal = data.paso;
				    	$scope.$emit('Titulo', { titulo: $scope.consultor.nombre, subtitulo: "Edición" });
				    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 
			}else{
				$scope.$emit('Titulo', { titulo: 'Consultor', subtitulo: 'Nuevo' });
				$scope.consultor = {};
			}


	 		$scope.Ok = function(consultor){
	 			if (!frm.$invalid) {
		  			Api.post('consultor/guardar', consultor).then(function(data){
						$.growl('Guardado', {type: 'success'});
						$modalInstance.close(); }
					,function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					});
		  	 	}
		  	};

		  	$scope.agregarespecilidad = function(){
	  			Api.post('consultor/especilidad/', consultor).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$modalInstance.close(); }
				,function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
		  	};
		  	$scope.quitarespecilidad = function(especialidad){
		  		if (confirm('¿Desea eliminar el Registro?')) {
		  			Api.post('consultor/quitarespecialidad/', especialidad.id).then(function(data){
						$.growl('Eliminado', {type: 'success'});
						$modalInstance.close(); }
					,function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					})
	  			}
		  	};
	})

	// Paso 2
	.controller('ConsultorEspecialidadesCtrl', function (Api,$log, $routeParams, $scope, $modal) {
		$scope.pasoActual = 2;
		// Verificar si si creara o editara
		    Api.get('consultor/'+ $routeParams.id).then(function(data){ 
		    	$scope.consultor = data;
		    	$scope.pasoReal = data.paso;
		    	$scope.$emit('Titulo', { titulo: $scope.consultor.nombre, subtitulo: "Edición" });
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 

		  	$scope.agregar = function (consultor) {
		  	    var modalInstance = $modal.open({
		  	      	templateUrl: 'app/views/consultores/listaespecialidades.html',
		  	      	windowClass: 'normal',
		  	      	backdrop : 'static',
		  	     	controller:  function ($scope, $modalInstance, $modal, consultor) {
		  	     		$scope.consultor = consultor;
		  	     		$scope.imagenes = [];

		  	     		Api.get('especialidades').then(function(data){
		  	     			$scope.especialidades = data;
		  	     		}, function (data){
 							$.growl('No se pudieron cargar las especialidades', {type: 'warning'});
		  	     		});

		  	     		$scope.select = function(especilidad){
		  	     			$scope.consultorespecialidad = {};
		  	     			$scope.consultorespecialidad.especialidad_id = especilidad.id;
		  	     			$scope.consultorespecialidad.consultor_id = $scope.consultor.id;

			  	     		Api.post('consultor/especialidad', $scope.consultorespecialidad).then(function(data){
	 							$.growl('Guardado', {type: 'success'});
	 							$scope.consultor.especialidades.push(data);
	 							$modalInstance.close(); 
	 						},function (data){
	 							$.growl('No se pudo guardar', {type: 'warning'});
	 						});
		  	     		};
		  	     		$scope.cancelar = function(){$modalInstance.close(); };

		  			},
		  			resolve: {
		  		        consultor: function () {
		  		          return $scope.consultor;
		  		        }
		  		    }});
		  		};

		  	$scope.quitarespecilidad = function(especialidad){
		  		console.log(especialidad.id);
		  		if (confirm('¿Desea eliminar el Registro?')) {
		  			Api.post('consultor/delespecialidad/' + especialidad.id).then(function(data){
						$.growl('Eliminado', {type: 'success'});
						for (var i in $scope.consultor.especialidades ) {
							if ($scope.consultor.especialidades[i].id === data.id ){
								$scope.consultor.especialidades.splice(i, 1);
							}
						}
					},function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					})
	  			}
		  	};
	})

	// Paso 3
	.controller('ConsultorHistorialCtrl', function (Api,$log, $routeParams, $scope, $modal) {
		$scope.pasoActual = 3;
		// Verificar si si creara o editara
		    Api.get('consultor/'+ $routeParams.id).then(function(data){ 
		    	$scope.consultor = data;
		    	$scope.pasoReal = data.paso;
		    	$scope.$emit('Titulo', { titulo: $scope.consultor.nombre, subtitulo: "Edición" });
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	})

// AT
	.controller('ATCtrl', function (Api, $scope, $location, $log, $modal) {

		$scope.$emit('Titulo', { titulo: 'Asistencias', subtitulo: 'Listado' });
		$scope.atterminos = [];
		$scope.dtInstancia = {};

		$scope.cargar = function () {
		    Api.get('asistencias').then(function(data){ $scope.atterminos = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		};

		$scope.crear = function(){ $location.path('/asistencia/empresa/nuevo') };

		$scope.actualizar = function(termino){ 
			switch(termino.paso){
				case 2:
					$location.path('/asistencia/tdr/' + termino.id); 
					break
				case 3:
					$location.path('/asistencia/consultores/' + termino.id); 
					break
				case 4:
					$location.path('/asistencia/enviados/' + termino.id); 
					break
				case 5:
					$location.path('/asistencia/ofertantes/' + termino.id); 
					break
				case 6:
					$location.path('/asistencia/contrato/' + termino.id); 
					break
				case 7:
					$location.path('/asistencia/acta/' + termino.id); 
					break
				case 8:
					$location.path('/asistencia/final/' + termino.id); 
					break

			}
		};

		// Eliminar
		$scope.eliminar = function(attermino){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('attermino/eliminar/'+ attermino.id).then(function(data){
					$.growl('Guardado', {type: 'success'});
					for (var i in $scope.atterminos ) {
						if ($scope.atterminos[i].id === data.id ){
							$scope.atterminos.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};

	})
	// Paso 1
	.controller('ATEmpresaCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 1;

		if ($routeParams.id>0) {
			Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
		    	$scope.asistencia = data;
		    	$scope.pasoReal = data.paso;
		    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
		    	$scope.pasoReal = data.paso;
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
		}
		else{
			Api.get('empresas').then(function(data){ 
		    	$scope.empresas = data;
		    	$scope.$emit('Titulo', { titulo: "Empresa", subtitulo: "Creando" });
		    	$scope.pasoReal = 1;

		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
		}
		
	})
	// Paso 2
	.controller('ATTdrCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 2;

		if ($routeParams.id>0) {
			Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
		    	$scope.asistencia = data;
		    	$scope.pasoReal = data.paso;
		    	$scope.$emit('Titulo', { titulo: $scope.asistencia.empresa.nombre, subtitulo: "Termino" });
		    	$scope.pasoReal = data.paso;
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
		}
		else{
			Api.get('empresas').then(function(data){ 
		    	$scope.empresas = data;
		    	$scope.$emit('Titulo', { titulo: "Empresa", subtitulo: "Creando" });
		    	$scope.pasoReal = 1;

		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
		}

 		$scope.Ok = function(tdr){
 			console.log(tdr);
 			if (!frm.$invalid) {
	  			Api.post('asistencia/guardar/', tdr).then(function(data){
					$.growl('Guardado', {type: 'success'});
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
	})
	// Paso 3
	.controller('ATConsultoresCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 3;
		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
	    	$scope.pasoReal = data.paso;

    		Api.get('consultores/porespecialidad/'+ data.especialidad_id).then(function(data){ 
    	    	$scope.consultores = data;
    	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		$scope.Ok = function(consultores){
 			console.log(consultores);
 			if (!frm.$invalid) {
	  			Api.post('asistencia/enviartermino/', consultor).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$modalInstance.close(); }
				,function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
		
	})
	// Paso 4
	.controller('ATEnviadosCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 4;
		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
	    	$scope.pasoReal = data.paso;

    		Api.get('asistencia/enviados/'+ $routeParams.id).then(function(data){ 
    	    	$scope.consultores = data;
    	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		$scope.Ok = function(consultores){

 			console.log(consultores);
 			if (!frm.$invalid) {
	  			Api.post('asistencia/enviartermino/', consultor).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$modalInstance.close(); }
				,function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
		
	})
	// Paso 5
	.controller('ATOfertantesCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 5;
		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
	    	$scope.pasoReal = data.paso;

    		Api.get('asistencia/enviados/'+ $routeParams.id).then(function(data){ 
    	    	$scope.consultores = data;
    	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		$scope.Ok = function(consultores){

 			console.log(consultores);
 			if (!frm.$invalid) {
	  			Api.post('asistencia/enviartermino/', consultor).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$modalInstance.close(); }
				,function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
		
	})
	// Paso 6
	.controller('ATContratoCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 6;

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
	    	$scope.pasoReal = data.paso;

    		Api.get('contrato/'+ $routeParams.id).then(function(data){ 
    	    	$scope.contrato = data;
    	    	console.log(data);
    	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		$scope.Ok = function(contrato){

 			console.log(contrato);
 			if (!frm.$invalid) {
	  			Api.post('contrato/guardar/', contrato).then(function(data){
					$.growl('Guardado', {type: 'success'});
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
		
	})
	// Paso 7
	.controller('ATActaCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 7;

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
	    	$scope.pasoReal = data.paso;

    		Api.get('acta/'+ $routeParams.id).then(function(data){ 
    	    	$scope.acta = data;
    	    	console.log(data);
    	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		
 		$scope.Ok = function(acta){
 			acta.attermino_id = $routeParams.id;
 			console.log(acta);
 			if (!frm.$invalid) {
	  			Api.post('acta/guardar', acta).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$scope.pasoReal = 8;
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
	})
	// Paso 8
	.controller('ATFinalCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 8;

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: $scope.asistencia.id, subtitulo: "Edición" });
	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });		
		
	})

.controller('CapTerminoCtrl', function (Api, $scope, $log, $modal) {

	$scope.$emit('Titulo', { titulo: 'Capacitaciones', subtitulo: 'Listado' });
	$scope.capacitaciones = [];
	$scope.dtInstancia = {};

	$scope.cargar = function () {
	    Api.get('capacitaciones').then(function(data){ $scope.capacitaciones = data;
	    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
	};


	// Eliminar
	$scope.eliminar = function(capacitacion){
		if (confirm('¿Desea eliminar el Registro?')) {
			Api.post('capacitacion/eliminar/'+ capacitacion.id).then(function(data){
				$.growl('Guardado', {type: 'success'});
				for (var i in $scope.atterminos ) {
					if ($scope.atterminos[i].id === data.id ){
						$scope.atterminos.splice(i, 1);
					}
				}
  			}, function (data){
				$.growl('No se pudo eliminar', {type: 'warning'});
			});
		}
	};

})


.controller('UsuariosCtrl', function (Api, $scope, $log, $modal){
	
	$scope.$emit('Titulo', { titulo: "Usuarios", subtitulo: "Listado" });
	$scope.dtInstancia = {};
	$scope.usuarios = [];

    $scope.cargar = function () {
	    Api.get('usuarios/ver').then(function(data){ $scope.usuarios = data;
	    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
	};

	$scope.crear = function (usuarios) {
	    var modalInstance = $modal.open({
	      	templateUrl: 'app/views/usuarios/form.html',
	      	windowClass:'normal', backdrop : 'static',
	     	controller:  function ($scope, $modalInstance, usuarios) {
	     		$scope.usuarios = usuarios;
	     		$scope.usuario = {};
	     		$scope.usuario.avatar = 'h_0.png';
	     		$scope.Ok = function(usuario){
	     			console.log(usuario);
	     			if (!frm.$invalid) {
			  			Api.post('usuarios/guardar', usuario).then(function(data){
							$scope.usuarios.unshift(data);
							$scope.usuario = {};
							$.growl('Guardado', {type: 'success'});
			  			},
							function (data){
								$.growl('No se pudo guardar', {type: 'warning'});
							}
			  			);	
			  	 	}
			  	};
			  	$scope.Cancelar = function () {
				    $modalInstance.close();
				};
			},
			resolve: {
				usuarios: function(){
					return $scope.usuarios;
				}
			}
	    });
	};

	$scope.actualizar = function (usuario) {
	    var modalInstance = $modal.open({
	      	templateUrl: 'app/views/usuarios/form.html',
	      	windowClass:'normal', backdrop : 'static',
	     	controller:  function ($scope, $modalInstance, usuario) {
	     		$scope.usuario = usuario;
	     	// Guardar
	     		$scope.Ok = function(usuario){
	     			if (!frm.$invalid) {
			  	 		Api.post('usuarios/guardar', usuario).then(function(data){
			  	 			$modalInstance.close();
			  	 			$.growl('Guardado', {type: 'success'});
  	 		  			}, function (data){
							$.growl('No se pudo guardar', {type: 'warning'});
  	 					});
			  	 	}
			  	};
			  	$scope.Cancelar = function () {
				    $modalInstance.dismiss('cancelar');
				};
			},
			resolve: {
		        usuario: function () {
		          return usuario;
		        }
		    }
	    });
	};

	$scope.eliminar = function(usuario){
		if (confirm('¿Desea eliminar el Registro?')) {
			Api.post('usuarios/eliminar/'+ usuario.id).then(function(data){
				$.growl('Eliminado', {type: 'success'});
				for (var i in $scope.usuarios ) {
					if ($scope.usuarios[i].id === data.id ){
						$scope.usuarios.splice(i, 1);
					}
				}
  			}, function (data){
				$.growl('No se pudo eliminar', {type: 'warning'});
			});
		}
	};

})

.controller('PerfilCtrl', function (Api, $scope, $modal) {
	// Perfil

	$scope.usuario = {};
	$scope.cargar = function () {
		Api.get('usuarios/auth').then(function(data){ $scope.usuario = data;
		}, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
	};
		
	$scope.perfil = function (usuario) {
	    var modalInstance = $modal.open({
	      	templateUrl: 'app/views/usuarios/perfil.html',
	      	windowClass: 'normal',
	      	backdrop : 'static',
	     	controller:  function ($scope, $modalInstance, $modal, usuario) {
	     		$scope.usuario = usuario;
	     		$scope.imagenes = [];

	     		for (var i = 1; i <= 12; i++) {
	     			$scope.imagenes.unshift({'nombre':'h_' + i +'.png'});
	     			$scope.imagenes.unshift({'nombre':'m_' + i +'.png'});
	     		};

	     		$scope.Ok = function(usuario){
	     			console.log(usuario);
	     			if (!form.$invalid) {
			  			Api.post('usuarios/guardar', usuario).then(function(data){
							$scope.usuario = data;
							$.growl('Guardado', {type: 'success'});
							$modalInstance.close();
			  			},
							function (data){
							$.growl('No se pudo guardar', {type: 'warning'});
						});
			  	 	}};
			  	$scope.Cancelar = function () {
				    $modalInstance.dismiss('cancelar');
				};
			},
			resolve: {
		        usuario: function () {
		          return $scope.usuario;
		        }
		    }});
		};
});