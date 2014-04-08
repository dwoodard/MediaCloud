'use strict';

// Declare app level module which depends on filters, and services
var app = angular.module('manage',['ngResource','xeditable','ui.bootstrap'],
	function($interpolateProvider){
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	});


app.run(function(editableOptions) {
  editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
});

app.factory('Collections', function($http) {

	var dataFactory = {};

	dataFactory.getCollections = function () {
		return $http.get('/collections');
	};

	
	return dataFactory;
});


app.controller('manageController', function($scope, $http, $location, Collections) {

	Collections.getCollections().success(function (data) {
		$scope.collections = data;
	})

	$scope.getCollectionView = function(e) {
		Manage.getCollection(e.id);
	};


})