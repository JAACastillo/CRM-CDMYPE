'use strict';

var app = angular.module('app', ['ngRoute','datatables', 'datatables.buttons', 'ngSanitize','ui.bootstrap', 'chart.js', 'ui.calendar', 'Services', 'Directives', 'Controllers'])

.factory('RequestInterceptor', ['CSRF_TOKEN', function(CSRF_TOKEN) {var requestInterceptor = {request: function(config) {config.headers['x-session-token'] = CSRF_TOKEN._token; return config; } }; return requestInterceptor; }])
.config(['$httpProvider', function($httpProvider) {$httpProvider.defaults.useXDomain = true; $httpProvider.interceptors.push('RequestInterceptor'); }])

.config(['$routeProvider', function ($routeProvider){
	$routeProvider
		.when('/',{
			controller: 'DashCtrl',
			templateUrl: 'app/views/dash/index.html'
		})
		
		// Clientes
			// Empresas
				.when('/empresas',{
					controller: 'EmpresasCtrl',
					templateUrl: 'app/views/clientes/empresas/index.html'
				})
				.when('/clientes/empresa/:id',{
					controller: 'EmpresaCtrl',
					templateUrl: 'app/views/clientes/empresas/empresa.html'
				})

				.when('/clientes/empresa/empresarios/:id',{
					controller: 'EmpresaEmpresarioCtrl',
					templateUrl: 'app/views/clientes/empresas/empresarios.html'
				})

				.when('/clientes/empresa/indicadores/:id',{
					controller: 'EmpresaIndicadoresCtrl',
					templateUrl: 'app/views/clientes/empresas/indicadores.html'
				})

				.when('/clientes/empresa/historial/:id',{
					controller: 'EmpresaHistorialCtrl',
					templateUrl: 'app/views/clientes/empresas/historial.html'
				})
			// Empresarios
				.when('/empresarios',{
					controller: 'EmpresariosCtrl',
					templateUrl: 'app/views/clientes/empresarios/index.html'
				})
				.when('/clientes/empresario/:id',{
					controller: 'EmpresarioCtrl',
					templateUrl: 'app/views/clientes/empresarios/empresario.html'
				})

				.when('/clientes/empresario/empresas/:id',{
					controller: 'EmpresarioEmpresaCtrl',
					templateUrl: 'app/views/clientes/empresarios/empresas.html'
				})

				.when('/clientes/empresario/historial/:id',{
					controller: 'EmpresarioHistorialCtrl',
					templateUrl: 'app/views/clientes/empresarios/historial.html'
				})

		// Consultores
			.when('/consultores',{
				controller: 'ConsultoresCtrl',
				templateUrl: 'app/views/consultores/index.html'
			})
			.when('/consultor/:id',{
				controller: 'ConsultorCtrl',
				templateUrl: 'app/views/consultores/form.html'
			})
			.when('/consultor/especialidades/:id',{
				controller: 'ConsultorEspecialidadesCtrl',
				templateUrl: 'app/views/consultores/especialidades.html'
			})
			.when('/consultor/historial/:id',{
				controller: 'ConsultorHistorialCtrl',
				templateUrl: 'app/views/consultores/historial.html'
			})
		
		// AT
			.when('/asistencias',{
				controller: 'ATCtrl',
				templateUrl: 'app/views/terminos/index.html'
			})
			// .when('/asistencia/empresa/:id',{
			// 	controller: 'ATEmpresaCtrl',
			// 	templateUrl: 'app/views/terminos/empresa.html'
			// })
			.when('/asistencia/tdr/:id',{
				controller: 'ATTdrCtrl',
				templateUrl: 'app/views/terminos/tdr.html'
			})
			.when('/asistencia/consultores/:id',{
				controller: 'ATConsultoresCtrl',
				templateUrl: 'app/views/terminos/consultores.html'
			})
			.when('/asistencia/enviados/:id',{
				controller: 'ATEnviadosCtrl',
				templateUrl: 'app/views/terminos/enviados.html'
			})
			.when('/asistencia/ofertantes/:id',{
				controller: 'ATOfertantesCtrl',
				templateUrl: 'app/views/terminos/ofertantes.html'
			})
			.when('/asistencia/contrato/:id',{
				controller: 'ATContratoCtrl',
				templateUrl: 'app/views/terminos/contrato.html'
			})
			.when('/asistencia/acta/:id',{
				controller: 'ATActaCtrl',
				templateUrl: 'app/views/terminos/acta.html'
			})
			.when('/asistencia/final/:id',{
				controller: 'ATFinalCtrl',
				templateUrl: 'app/views/terminos/final.html'
			})

		// Eventos
			.when('/eventos',{
				controller: 'EventosCtrl',
				templateUrl: 'app/views/eventos/index.html'
			})

			.when('/evento/:id',{
				controller: 'EventoCtrl',
				templateUrl: 'app/views/eventos/form.html'
			})

		// Salidas
			.when('/salidas',{
				controller: 'SalidasCtrl',
				templateUrl: 'app/views/salidas/index.html'
			})

			.when('/salida/:id',{
				controller: 'SalidaCtrl',
				templateUrl: 'app/views/salidas/form.html'
			})

		.when('/usuarios',{
			controller: 'UsuariosCtrl',
			templateUrl: 'app/views/usuarios/index.html'
		})
		.when('/empresa',{
			controller: 'EmpresaCtrl',
			templateUrl: 'app/views/empresa/index.html'
		})
		.when('/reportes',{
			controller: 'ReportesCtrl',
			templateUrl: 'app/views/reportes/index.html'
		})
		.otherwise({
			redirectTo: '/'
		})
}]);
