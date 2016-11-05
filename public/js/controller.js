angular.module('Websis', [])

.constant("config", {
	"url": "http://localhost:8000/"
})

.controller('PortfolioCtrl', ['$scope', function ($scope){

	$scope.portfolio = 	[
		{	nombre: 'Websis Shop', 
			descripcion: 'Página web, tienda online y sistema.',
			img: 'MO-01.svg',
			tags: 'html',
			delay: '500ms'
		},
		{	nombre: 'Go', 
			descripcion: 'Aplicación de eventos.',
			img: 'MO-02.svg',
			tags: 'css',
			delay: '1000ms'
		},
		{	nombre: 'Cabal', 
			descripcion: 'Sistema de Inventario.',
			img: 'MO-03.svg',
			tags: 'js',
			delay: '1500ms'
		},
		{	nombre: 'Lab', 
			descripcion: 'Sistema para laboratorios clinicos.',
			img: 'MO-05.svg',
			tags: 'html',
			delay: '2000ms'
		},
		{	nombre: 'Websis Shop', 
			descripcion: 'Página web, tienda online y sistema.',
			img: 'MO-01.svg',
			tags: 'html',
			delay: '2500ms'
		},
		{	nombre: 'Go', 
			descripcion: 'Aplicación de eventos.',
			img: 'MO-02.svg',
			tags: 'css',
			delay: '3000ms'
		},
		{	nombre: 'Cabal', 
			descripcion: 'Sistema de Inventario.',
			img: 'MO-03.svg',
			tags: 'js',
			delay: '3500ms'
		},
		{	nombre: 'Lab', 
			descripcion: 'Sistema para laboratorios clinicos.',
			img: 'MO-05.svg',
			tags: 'html',
			delay: '4000ms'
		}
					];

}])

.controller('TecnologiasCtrl', ['$scope', function ($scope) {
	
	$scope.logos = 	[
		{url: 'http://www.w3schools.com/html', img: 'html'},
		{url: 'http://www.w3schools.com/js', img: 'js'},
		{url: 'http://www.w3schools.com/css', img: 'css'},
		{url: 'http://laravel.com', img: 'laravel'},
		{url: 'https://angularjs.org', img: 'angular'},
		{url: 'http://getbootstrap.com', img: 'bootstrap'},
		{url: 'https://github.com', img: 'github'},
		{url: 'http://ionicframework.com', img: 'ionic'},
		{url: 'https://www.mysql.com', img: 'mysql'},
		{url: 'https://nodejs.org', img: 'node'},
		{url: 'http://www.sublimetext.com', img: 'sublime'},
		// {url: 'http://gruntjs.com', img: 'grunt'},
		{url: 'https://cordova.apache.org', img: 'cordova'}
					];

}])

.controller('ContactoCtrl', ['$scope', '$http', 'config', function ($scope, $http, config) {
	
	$scope.loader = false;
	$scope.correo = "";

	$scope.email = function(correo){
		console.log(correo);
		if($scope.correo){
			$scope.loader = true;
			$http.post(config.url + 'correo', $scope.correo).
			  success(function(data, status) {
			    if (status == 200) {
			    	$scope.correo = {};
			    	$scope.loader = false;
			    	$('#email').modal('hide')
				}else{
				    $scope.loader = false;
				    $scope.emailErrores = data;
				}
			  }).
			  error(function(data, status) {
			  	$scope.loader = false;
			    $scope.emailErrores = ["El correo no se envio, intente más tarde."];
			  });
		}
	}

}])
;