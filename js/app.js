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
  $routeProvider.when('/', {templateUrl: 'index.php', controller: 'MyCtrl1'});
  $routeProvider.when('/CreateAccount', {templateUrl: 'partials/create.html', controller: 'MyCtrl2'});
  $routeProvider.when('/Membership', {templateUrl: 'partials/member.html', controller: 'MyCtrl2'});
  $routeProvider.when('/Support', {templateUrl: 'partials/support.html', controller: 'MyCtrl2'});
  $routeProvider.when('/About', {templateUrl: 'partials/about.html', controller: 'MyCtrl2'});
  $routeProvider.otherwise({redirectTo: '/'});
}]);
