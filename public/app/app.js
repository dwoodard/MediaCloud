'use strict';

// Declare app level module which depends on filters, and services
var mcApp = angular.module('mcApp',
		['ngRoute'],
		function($interpolateProvider){
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	});

mcApp.config(function($routeProvider){
	$routeProvider

		.when('/',{
			templateUrl: 'app/templates/collections.html'
		})
		.when('/upload',{
			templateUrl: 'app/templates/upload.html'
		})
		.when('/browse',{
			templateUrl: 'app/templates/browse.html'
		})
		.otherwise({
			redirectTo: '/'
		});

		// if(window.history && window.history.pushState){
		// 	$locationProvider.html5Mode(true);
		// }

})
// mcApp.config(['$routeProvider', function($routeProvider) {
// 		$routeProvider.when('/view1', {templateUrl: 'partials/partial1.html', controller: 'MyCtrl1'});
// 		$routeProvider.when('/view2', {templateUrl: 'partials/partial2.html', controller: 'MyCtrl2'});
// 		$routeProvider.otherwise({redirectTo: '/view1'});
// 	}]);

