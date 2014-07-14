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
  $routeProvider.when('/', {templateUrl: 'view/home.html', controller: 'HomeController'});
  $routeProvider.when('/CreateAccount', {templateUrl: 'view/create.html', controller: 'CreateAccountController'});
  $routeProvider.when('/Membership', {templateUrl: 'view/member.html', controller: 'MembershipController'});
  $routeProvider.when('/Support', {templateUrl: 'view/support.html', controller: 'HomeController'});
  $routeProvider.when('/About', {templateUrl: 'view/about.html', controller: 'HomeController'});
  $routeProvider.otherwise({redirectTo: '/'});
}]);
