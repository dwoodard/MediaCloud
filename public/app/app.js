'use strict';

// Declare app level module which depends on filters, and services
var app = angular.module('manage',['ngResource','xeditable'],
	function($interpolateProvider){
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
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