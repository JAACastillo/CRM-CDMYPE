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

    Api.get('usuarios/auth').then(function(data){ 
	    if (data.tipo == 'Compras') {
	    	cargarCompras();
	    }
	    else{
	    	console.log('Asesor');

	    }
    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

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

	// Empresas
		.controller('EmpresasCtrl', function (Api, $scope, $location, $modal) {
			
			$scope.$emit('Titulo', { titulo: 'Empresas', subtitulo:'Listado' });
			$scope.empresas = [];
			$scope.dtInstancia = {};

			$scope.cargar = function () {
			    Api.get('empresas').then(function(data){ $scope.empresas = data;
			    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
			};

			$scope.crear = function(){ $location.path('clientes/empresa/nueva') };

			$scope.actualizar = function(empresa){ $location.path('clientes/empresa/' + empresa.id); };

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
		.controller('EmpresaCtrl', function (Api, $location, $routeParams, $scope, $modal) {
			$scope.pasoActual = 1;
			$scope.empresa = {};
			// Verificar si si creara o editara
				if ($routeParams.id>0) {
				    Api.get('empresa/'+ $routeParams.id).then(function(data){ 
				    	$scope.empresa = data;
				    	$scope.pasoReal = data.paso;
				    	$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });
				    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 
				}else{
					$scope.$emit('Titulo', { titulo: 'Empresa', subtitulo: 'Nuevo' });
					$scope.empresa = {};
					$scope.pasoReal = 1;
				}

		 		$scope.Ok = function(empresa){
		 			if (!frm.$invalid) {
			  			Api.post('empresa/guardar', empresa).then(function(data){
							$.growl('Guardado', {type: 'success'});
							$location.path('/clientes/empresa/' + data.id);
						} ,function (data){
							$.growl('No se pudo guardar', {type: 'warning'});
						});
			  	 	}
			  	};
		})

		// Paso 2
		.controller('EmpresaEmpresarioCtrl', function (Api, $location, $routeParams, $scope, $modal) {

			$scope.pasoActual = 2;

			Api.get('empresa/'+ $routeParams.id).then(function(data){ 
				$scope.empresa = data;
				$scope.pasoReal = data.paso;
				$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });
			}, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 

			$scope.agregar = function (empresa) {
			    var modalInstance = $modal.open({
			      	templateUrl: 'app/views/clientes/empresas/modal.html',
			      	windowClass: 'normal',
			     	controller:  function ($scope, $modalInstance, $modal, empresa) {
			     		$scope.empresario = {};

			     		$scope.cargarEmpresarios = function(){Api.get('empresarios').then(function(data){$scope.empresarios = data; }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); }

			     		$scope.select = function(entidad){$scope.empresario.empresario_id = entidad.id; $scope.empresario.nombre = entidad.nombre; };

			     		$scope.Ok = function(empresario){
			     			empresario.empresa_id = empresa.id;
			     			console.log(empresario);
			     			if (!frm.$invalid) {
					  			Api.post('empresaempresario/guardar', empresario).then(function(data){
									empresa.empresarios.push(data);
									$.growl('Guardado', {type: 'success'});
									$modalInstance.close();
					  			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
					  	 	}};
					  	$scope.Cancelar = function () { $modalInstance.close(); };
					},
					resolve: {
				        empresa: function () { return $scope.empresa; }
				    }});
				};
			
			$scope.actualizar = function (empresario) {
			    var modalInstance = $modal.open({
			      	templateUrl: 'app/views/clientes/empresas/modal.html',
			      	windowClass: 'normal',
			     	controller:  function ($scope, $modalInstance, $modal, empresario) {
			     		$scope.empresario = empresario;
			     		$scope.empresario.nombre = empresario.empresario;

			     		$scope.cargarEmpresarios = function(){Api.get('empresarios').then(function(data){$scope.empresarios = data; }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); }

			     		$scope.select = function(entidad){$scope.empresario.empresario_id = entidad.id; $scope.empresario.nombre = entidad.nombre; };

			     		$scope.Ok = function(empresario){
			     			if (!frm.$invalid) {
					  			Api.post('empresaempresario/guardar', empresario).then(function(data){
					  				empresario = data;
					  				console.log(data);
									$.growl('Guardado', {type: 'success'});
									$modalInstance.close();
					  			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
					  	 	}};
					  	$scope.Cancelar = function () { $modalInstance.close(); };
					},
					resolve: {
				        empresario: function () { return empresario; }
				    }});
				};

			// Eliminar
			$scope.eliminar = function(empresario){
				if (confirm('¿Desea eliminar el Registro?')) {
					Api.post('empresaempresario/eliminar/'+ empresario.id).then(function(data){
						$.growl('Eliminado', {type: 'success'});
						for (var i in $scope.empresa.empresarios ) {
							if ($scope.empresa.empresarios[i].id === data.id ){
								$scope.empresa.empresarios.splice(i, 1);
							}
						}
		  			}, function (data){
						$.growl('No se pudo eliminar', {type: 'warning'});
					});
				}
			};

		})

		// Paso 3
		.controller('EmpresaIndicadoresCtrl', function (Api, $scope, $routeParams, $location, $modal) {
			
			$scope.pasoActual = 3;

			// Verificar si si creara o editara
			Api.get('empresa/'+ $routeParams.id).then(function(data){ 
				$scope.empresa = data;
				$scope.indicadores = data.indicadores;
				$scope.pasoReal = data.paso;
				$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });
			}, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 

	 		$scope.Ok = function(indicadores){
	 			indicadores.empresa_id = $routeParams.id;
				console.log(indicadores);

	 			if (!frm.$invalid) {
		  			Api.post('indicador/guardar', indicadores).then(function(data){
						$.growl('Guardado', {type: 'success'});
						$location.path('/clientes/empresa/indicadores/' + $routeParams.id);
					} ,function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					});
		  	 	}
		  	};

		})

		// Paso 4
		.controller('EmpresaHistorialCtrl', function (Api, $scope, $routeParams, $location, $modal) {
			
			$scope.pasoActual = 4;
			// Verificar si si creara o editara
				Api.get('empresa/historial/'+ $routeParams.id).then(function(data){ 
					$scope.empresa = data;
					$scope.pasoReal = data.paso;
					console.log(data);
					$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });

			    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

		})

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

			Api.get('empresario/'+ $routeParams.id).then(function(data){ 
				$scope.empresario = data;
				$scope.pasoReal = data.paso;
				$scope.$emit('Titulo', { titulo: $scope.empresario.nombre, subtitulo: "Edición" });
			}, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 

				$scope.agregar = function (empresario) {
				    var modalInstance = $modal.open({
				      	templateUrl: 'app/views/clientes/empresarios/modal.html',
				      	windowClass: 'normal',
				     	controller:  function ($scope, $modalInstance, $modal, empresario) {
				     		$scope.empresa = {};

				     		$scope.cargarEmpresas = function(){Api.get('empresas').then(function(data){$scope.empresas = data; }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); }

				     		$scope.select = function(entidad){$scope.empresa.empresa_id = entidad.id; $scope.empresa.nombre = entidad.nombre; };

				     		$scope.Ok = function(empresa){
				     			empresa.empresario_id = empresario.id;
				     			console.log(empresa);
				     			if (!frm.$invalid) {
						  			Api.post('empresaempresario/guardar', empresa).then(function(data){
										empresario.empresas.push(data);
										$.growl('Guardado', {type: 'success'});
										$modalInstance.close();
						  			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
						  	 	}};
						  	$scope.Cancelar = function () { $modalInstance.close(); };
						},
						resolve: {
					        empresario: function () { return $scope.empresario; }
					    }});
					};
				
				$scope.actualizar = function (empresa) {
				    var modalInstance = $modal.open({
				      	templateUrl: 'app/views/clientes/empresarios/modal.html',
				      	windowClass: 'normal',
				     	controller:  function ($scope, $modalInstance, $modal, empresa) {
				     		$scope.empresa = empresa;
				     		$scope.empresa.nombre = empresa.empresa;
				     		console.log(empresa);

				     		$scope.cargarEmpresas= function(){Api.get('empresas').then(function(data){$scope.empresas = data; }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); }

				     		$scope.select = function(entidad){$scope.empresa.empresa_id = entidad.id; $scope.empresa.nombre = entidad.nombre; };

				     		$scope.Ok = function(empresa){
				     			if (!frm.$invalid) {
						  			Api.post('empresaempresario/guardar', empresa).then(function(data){
						  				empresa = data;
						  				console.log(data);
										$.growl('Guardado', {type: 'success'});
										$modalInstance.close();
						  			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
						  	 	}};
						  	$scope.Cancelar = function () { $modalInstance.close(); };
						},
						resolve: {
					        empresa: function () { return empresa; }
					    }});
					};

				// Eliminar
				$scope.eliminar = function(empresario){
					if (confirm('¿Desea eliminar el Registro?')) {
						Api.post('empresaempresario/eliminar/'+ empresario.id).then(function(data){
							$.growl('Eliminado', {type: 'success'});
							for (var i in $scope.empresa.empresarios ) {
								if ($scope.empresa.empresarios[i].id === data.id ){
									$scope.empresa.empresarios.splice(i, 1);
								}
							}
			  			}, function (data){
							$.growl('No se pudo eliminar', {type: 'warning'});
						});
					}
				};


		})

		// Paso 3
		.controller('EmpresarioHistorialCtrl', function (Api, $scope, $routeParams, $location, $modal) {
			
			$scope.pasoActual = 4;

			Api.get('empresario/'+ $routeParams.id).then(function(data){ 
				$scope.empresario = data;
				$scope.pasoReal = data.paso;
				$scope.$emit('Titulo', { titulo: $scope.empresario.nombre, subtitulo: "Edición" });
				Api.get('empresa/historial/'+ $scope.empresario.empresas[0].empresa_id).then(function(data){ 
					$scope.empresa = data;
					$scope.pasoReal = data.paso;
					$scope.$emit('Titulo', { titulo: $scope.empresa.nombre, subtitulo: "Edición" });

			    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
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
	.controller('ConsultorCtrl', function (Api,$location, $routeParams, $scope, $modal) {
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
				$scope.pasoReal = 1;
				$scope.consultor = {};
			}


	 		$scope.Ok = function(consultor){
	 			if (!frm.$invalid) {
		  			Api.post('consultor/guardar', consultor).then(function(data){
						$.growl('Guardado', {type: 'success'});
						$location.path('/consultor/'+ data.id);
					},function (data){
						$.growl('No se pudo guardar', {type: 'warning'});
					});
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

		$scope.crear = function(){ $location.path('/asistencia/tdr/nuevo') };

		$scope.actualizar = function(termino){ 
			switch(termino.paso){
				case 1:
					$location.path('/asistencia/tdr/' + termino.id); 
					break
				case 2:
					$location.path('/asistencia/consultores/' + termino.id); 
					break
				case 3:
					$location.path('/asistencia/enviados/' + termino.id); 
					break
				case 4:
					$location.path('/asistencia/ofertantes/' + termino.id); 
					break
				case 5:
					$location.path('/asistencia/contrato/' + termino.id); 
					break
				case 6:
					$location.path('/asistencia/acta/' + termino.id); 
					break
				case 7:
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
	.controller('ATTdrCtrl', function (Api, Dateme, $scope, $routeParams, $location, $modal) {
		$scope.pasoActual = 1;
		$scope.asistencia = {};

		if ($routeParams.id>0) {
			Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
		    	$scope.asistencia = data;
		    	$scope.search = data.empresa.nombre;
		    	$scope.empresarios = data.empresa.empresarios;
		    	$scope.emp = $scope.empresarios[0];
		    	$scope.pasoReal = data.paso;
		    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Termino" });
					Api.get('especialidades').then(function(data){
						$scope.especialidades = data;
						$scope.esp = $scope.especialidades[$scope.asistencia.especialidad_id - 1];
					},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

		}
		else{
  			Api.get('especialidades').then(function(data){
				$scope.especialidades = data;
			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
			$scope.asistencia = {};
			$scope.asistencia.fecha = Dateme.get();
			$scope.asistencia.trabajo_local = 70;
			$scope.asistencia.tiempo_ejecucion = 4;
			$scope.asistencia.financiamiento = 800;
			$scope.pasoReal = 2;
		}

 		$scope.Ok = function(tdr){
 			console.log(tdr);
 			if (!frm.$invalid) {
	  			Api.post('asistencia/guardar/', tdr).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$location.path('asistencia/tdr/' + data.id);
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};

	  	$scope.buscar = function(txt){
	  		if (txt) {
	  			Api.get('empresas/search/' + txt).then(function(data){ 
	  	    		$scope.empresas = data;
	  	    	}, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
	  		}else{$scope.empresas = []}
	  	};

	  	$scope.select = function(empresa){
	  		$scope.asistencia.empresa_id = empresa.id;
	  		$scope.search = empresa.nombre;
	  		$scope.asistencia.aporte = empresa.aporte;
	  		$scope.empresas = [];
  				Api.get('empresa/' + empresa.id).then(function(data){ 
  		    		$scope.empresarios = data.empresarios;
  		    	}, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });
	  	};
		
	})
	// Paso 2
	.controller('ATConsultoresCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 2;
		$scope.envio = false;
		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Consultores" });
	    	$scope.pasoReal = data.paso;

    		Api.get('consultores/porespecialidad/'+ data.especialidad_id).then(function(data){ 
    	    	$scope.consultores = data;
    	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		$scope.Ok = function(consultores){
 			$scope.envio = true;
  			Api.post('asistencia/enviartermino/', consultores).then(function(data){
				$scope.envio = false;
				$.growl('Enviado', {type: 'success'});
			},function (data){
				$.growl('No se pudo enviar', {type: 'warning'});
			});
	  	};
	})
	// Paso 3
	.controller('ATEnviadosCtrl', function (Api, $scope, $routeParams, $http, $modal) {
		$scope.pasoActual = 3;
		$scope.consultores = [];

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
    	    $scope.consultores = data.consultores;
	    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Consultores" });
	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

		$scope.eliminarDoc = function(id){
			var data = {};
			data.id = id;
  			Api.post('asistencia/eliminaroferta/', data).then(function(data){
				$.growl('Guardado', {type: 'success'});
				for (var i in $scope.consultores ) {
					if ($scope.consultores[i].id == id ){
						$scope.consultores[i].doc_oferta = "";
					}
				}
			},function (data){
				$.growl('No se pudo guardar', {type: 'warning'});
			});
		}

		$scope.uploadFile = function(files) {
		    var fd = new FormData();
		    //Take the first selected file
		    fd.append("id", files.target.id);
		    fd.append("file", event.target.files[0]);

		    $http.post('asistencia/guardaroferta/', fd, {withCredentials: true, headers: {'Content-Type': undefined }, transformRequest: angular.identity })
		    .then(function(data){
				$.growl('Guardado', {type: 'success'});
				// Asignar doc
					for (var i in $scope.consultores ) {
						if ($scope.consultores[i].id == data.data.id){
							$scope.consultores[i].doc_oferta = data.data.doc_oferta;
						}
					}
			},function (data){
				$.growl('No se pudo guardar', {type: 'warning'});
			});

		};		
	})
	// Paso 4
	.controller('ATOfertantesCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 4;
		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.consultores = data.ofertantes;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Ofertantes" });
	    	$scope.pasoReal = data.paso;

	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		$scope.seleccionar = function(consultor){
 			console.log(consultor);
  			Api.post('asistencia/seleccionarconsultor', consultor).then(function(data){
				$.growl('Guardado', {type: 'success'});
			},function (data){
				$.growl('No se pudo guardar', {type: 'warning'});
			});
	  	};
	})
	// Paso 5
	.controller('ATContratoCtrl', function (Api, Dateme, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 5;

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
		    	if (data.contrato) {
		    		$scope.contrato = data.contrato;
		    		$scope.contrato.aporte_empresario = data.aporte;
		    	}else{
		    		$scope.contrato = {};
		    		$scope.contrato.aporte = 100 - data.aporte;
		    		$scope.contrato.aporte_empresario = data.aporte;
		    		$scope.contrato.pago = 800;
		    		$scope.contrato.duracion = data.tiempo_ejecucion;
		    		$scope.contrato.fecha_inicio = Dateme.get();
		    	}
		    	if (data.ampliacion) {
		    		$scope.ampliacion = data.ampliacion;
		    	}else{
		    		$scope.ampliacion = {};
		    		$scope.ampliacion.fecha = Dateme.get();;
		    	}
	    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Contrato" });
	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });


 		$scope.Ok = function(contrato){
 			contrato.attermino_id = $scope.asistencia.id;
 			if (!frm.$invalid) {
	  			Api.post('contrato/guardar/', contrato).then(function(data){
	  				$scope.contrato = data;
					$.growl('Guardado', {type: 'success'});
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};

 		$scope.OkAmpliacion = function(ampliacion){
 			ampliacion.attermino_id = $scope.asistencia.id;
 			if (!frm.$invalid) {
	  			Api.post('ampliacion/guardar/', ampliacion).then(function(data){
	  				$scope.ampliacion = data;
					$.growl('Guardado', {type: 'success'});
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
	})
	// Paso 6
	.controller('ATActaCtrl', function (Api,Dateme, $scope, $routeParams, $modal) {
		$scope.pasoActual = 6;

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
		    	if (data.acta) {
	    			$scope.acta = data;
		    	}else{
	    			$scope.acta = {};
	    			$scope.acta.fecha = Dateme.get();
	    			$scope.acta.estado = 'Conformidad';
		    	}
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Acta" });
	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

 		
 		$scope.Ok = function(acta){
 			acta.attermino_id = $routeParams.id;
 			if (!frm.$invalid) {
	  			Api.post('acta/guardar', acta).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$scope.acta = data;
					$scope.pasoReal = 7;
				},function (data){
					$.growl('No se pudo guardar', {type: 'warning'});
				});
	  	 	}
	  	};
		
	})
	// Paso 7
	.controller('ATFinalCtrl', function (Api, $scope, $routeParams, $log, $modal) {
		$scope.pasoActual = 7;

		Api.get('asistencia/'+ $routeParams.id).then(function(data){ 
	    	$scope.asistencia = data;
	    	$scope.pasoReal = data.paso;
	    	$scope.$emit('Titulo', { titulo: data.empresa.nombre, subtitulo: "Final" });
	    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });		
		
	})


// Cap
	.controller('CapCtrl', function (Api, $scope, $location, $log, $modal) {

		$scope.$emit('Titulo', { titulo: 'Capacitaciones', subtitulo: 'Listado' });
		$scope.capterminos = [];
		$scope.dtInstancia = {};

		$scope.cargar = function () {
		    Api.get('capacitaciones').then(function(data){ $scope.capterminos = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		};

		$scope.crear = function(){ $location.path('/capacitaciones/tdr/nuevo') };

		$scope.actualizar = function(termino){ 
			switch(termino.paso){
				case 1:
					$location.path('/capacitacion/tdr/' + termino.id); 
					break
				case 2:
					$location.path('/capacitacion/consultores/' + termino.id); 
					break
				case 3:
					$location.path('/capacitacion/enviados/' + termino.id); 
					break
				case 4:
					$location.path('/capacitacion/ofertantes/' + termino.id); 
					break
				case 5:
					$location.path('/capacitacion/contrato/' + termino.id); 
					break
				case 6:
					$location.path('/capacitacion/acta/' + termino.id); 
					break
				case 7:
					$location.path('/capacitacion/final/' + termino.id); 
					break

			}
		};

		// Eliminar
		$scope.eliminar = function(captermino){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('capacitacion/eliminar/'+ captermino.id).then(function(data){
					$.growl('Guardado', {type: 'success'});
					for (var i in $scope.capterminos ) {
						if ($scope.capterminos[i].id === data.id ){
							$scope.capterminos.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};

	})

// Eventos
	.controller('EventosCtrl', function (Api, $scope, $location, $modal) {

		$scope.$emit('Titulo', { titulo: 'Eventos', subtitulo: 'Listado' });
		$scope.eventos = [];
		$scope.dtInstancia = {};

		$scope.cargar = function(){
		    Api.get('eventos').then(function(data){ $scope.eventos = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		}

		$scope.crear = function(){ $location.path('evento/nuevo') };

		$scope.actualizar = function(evento){ $location.path('evento/' + evento.id); };

		// Eliminar
		$scope.eliminar = function(evento){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('eventos/eliminar/'+ evento.id).then(function(data){
					$.growl('Eliminado', {type: 'success'});
					for (var i in $scope.eventos ) {
						if ($scope.eventos[i].id === data.id ){
							$scope.eventos.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};


	})
	.controller('EventoCtrl', function (Api, $scope, $routeParams, $modal) {

		if ($routeParams.id>0) {
		    Api.get('evento/'+ $routeParams.id).then(function(data){ 
		    	$scope.evento = data;
		    	$scope.$emit('Titulo', { titulo: 'Evento', subtitulo: "Edición" });
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 
		}else{
			$scope.$emit('Titulo', { titulo: 'Evento', subtitulo: 'Nuevo' });
			$scope.evento = {};
		}

		// Guardar evento
		$scope.Ok = function(evento){
 			if (!frm.$invalid) {
	  			Api.post('evento/guardar', evento).then(function(data){
					$.growl('Guardado', {type: 'success'});
					$location.path('/evento/' + data.id);
				} ,function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
	  	 	}
	  	};
		
		// Agregar participantes
		$scope.agregar = function (evento) {
		    var modalInstance = $modal.open({
	      	templateUrl: 'app/views/eventos/modal.html',
	      	windowClass: 'normal',
	     	controller:  function ($scope, $modalInstance, $modal, evento) {
	     		$scope.participante = {};
	     		$scope.participante.participacion = false;

	     		Api.get('empresarios').then(function(data){$scope.empresarios = data; }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	     		$scope.select = function(entidad){$scope.participante.empresario_id = entidad.id; $scope.participante.nombre = entidad.nombre; };

	     		$scope.Ok = function(participante){
	     			participante.evento_id = evento.id;
	     			console.log(participante);
	     			if (!frm.$invalid) {
			  			Api.post('participante/guardar', participante).then(function(data){
							evento.participantes.unshift(data);
							$.growl('Guardado', {type: 'success'});
							$modalInstance.close();
			  			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
			  	 	}};
			  	$scope.Cancelar = function () { $modalInstance.close(); };
			},
			resolve: {
		        evento: function () { return $scope.evento; }
		    }});
		};

		// Actualizar participante
		$scope.actualizar = function(participante){
  			Api.post('participante/guardar', participante).then(function(data){
				$.growl('Guardado', {type: 'success'});
			} ,function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
	  	};

  		// Eliminar participantes
  		$scope.eliminar = function(participante){
  			if (confirm('¿Desea eliminar el Registro?')) {
  				Api.post('participante/eliminar/'+ participante.id).then(function(data){
  					$.growl('Eliminado', {type: 'success'});
  					for (var i in $scope.evento.participantes ) {
  						if ($scope.evento.participantes[i].id === data.id ){
  							$scope.evento.participantes.splice(i, 1);
  						}
  					}
  	  			}, function (data){$.growl('No se pudo eliminar', {type: 'warning'}); });
  			}
  		};

	})

// Salidas
	.controller('SalidasCtrl', function (Api, $scope, $location, $modal) {

		$scope.$emit('Titulo', { titulo: 'Salidas', subtitulo: 'Listado' });
		$scope.salidas = [];
		$scope.dtInstancia = {};

		$scope.cargar = function(){
		    Api.get('salidas').then(function(data){ $scope.salidas = data;
		    }, function (data){ $.growl('No se pudieron cargar los datos', {type: 'warning'}); });
		}

		$scope.crear = function(){ $location.path('salida/nueva') };

		$scope.actualizar = function(salida){ $location.path('salida/' + salida.id); };

		// Agregar participantes
		$scope.print = function () {
		    var modalInstance = $modal.open({
	      	templateUrl: 'app/views/salidas/modal.html',
	      	windowClass: 'mini',
	     	controller:  function (Dateme, $scope, $modalInstance, $modal) {
	     		$scope.firma = 'director';
	     		$scope.ano = Dateme.ano();
	     		$scope.mes = Dateme.mes();
			}});
		};

		// Eliminar
		$scope.eliminar = function(salida){
			if (confirm('¿Desea eliminar el Registro?')) {
				Api.post('salidas/eliminar/'+ salida.id).then(function(data){
					$.growl('Eliminado', {type: 'success'});
					for (var i in $scope.salidas ) {
						if ($scope.salidas[i].id === data.id ){
							$scope.salidas.splice(i, 1);
						}
					}
	  			}, function (data){
					$.growl('No se pudo eliminar', {type: 'warning'});
				});
			}
		};
	})
	.controller('SalidaCtrl', function (Api, $scope, $routeParams, $modal) {

		if ($routeParams.id>0) {
		    Api.get('salida/'+ $routeParams.id).then(function(data){ 
		    	$scope.salida = data;
		    	$scope.$emit('Titulo', { titulo: 'Evento', subtitulo: "Edición" });
		    }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); }); 
		}else{
			$scope.$emit('Titulo', { titulo: 'Evento', subtitulo: 'Nuevo' });
			$scope.salida = {};
		}

		// Guardar salida
		$scope.Ok = function(salida){
 			if (!frm.$invalid) {
 				console.log(salida);
	  			Api.post('salida/guardar', salida).then(function(data){
					$.growl('Guardado', {type: 'success'});
				} ,function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
	  	 	}
	  	};
		
		// Agregar participantes
		$scope.agregar = function (salida) {
		    var modalInstance = $modal.open({
	      	templateUrl: 'app/views/salidas/modal.html',
	      	windowClass: 'normal',
	     	controller:  function ($scope, $modalInstance, $modal, salida) {
	     		$scope.participante = {};
	     		$scope.participante.participacion = false;

	     		Api.get('empresarios').then(function(data){$scope.empresarios = data; }, function (data){ $.growl('No se pudieron cargar los datos: ' + data, {type: 'warning'}); });

	     		$scope.select = function(entidad){$scope.participante.empresario_id = entidad.id; $scope.participante.nombre = entidad.nombre; };

	     		$scope.Ok = function(participante){
	     			participante.salida_id = salida.id;
	     			console.log(participante);
	     			if (!frm.$invalid) {
			  			Api.post('participante/guardar', participante).then(function(data){
							salida.participantes.unshift(data);
							$.growl('Guardado', {type: 'success'});
							$modalInstance.close();
			  			},function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
			  	 	}};
			  	$scope.Cancelar = function () { $modalInstance.close(); };
			},
			resolve: {
		        salida: function () { return $scope.salida; }
		    }});
		};

		// Actualizar participante
		$scope.actualizar = function(participante){
  			Api.post('participante/guardar', participante).then(function(data){
				$.growl('Guardado', {type: 'success'});
			} ,function (data){$.growl('No se pudo guardar', {type: 'warning'}); });
	  	};

  		// Eliminar participantes
  		$scope.eliminar = function(participante){
  			if (confirm('¿Desea eliminar el Registro?')) {
  				Api.post('participante/eliminar/'+ participante.id).then(function(data){
  					$.growl('Eliminado', {type: 'success'});
  					for (var i in $scope.evento.participantes ) {
  						if ($scope.evento.participantes[i].id === data.id ){
  							$scope.evento.participantes.splice(i, 1);
  						}
  					}
  	  			}, function (data){$.growl('No se pudo eliminar', {type: 'warning'}); });
  			}
  		};
	})


// Usuarios
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