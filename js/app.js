'use strict';


// Declare app level module which depends on filters, and services
angular.module('octosurvey', [
  'ngRoute',
  'octosurvey.filters',
  'octosurvey.services',
  'octosurvey.directives',
  'octosurvey.controllers'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/', {templateUrl: 'partials/home.html', controller: 'MyCtrl1'});
  $routeProvider.when('/CreateAccount', {templateUrl: 'partials/CreateAccount.html', controller: 'MyCtrl2'});
  $routeProvider.otherwise({redirectTo: '/'});
}]);
