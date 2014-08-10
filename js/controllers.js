'use strict';

/* Controllers */

angular.module('octosurvey.controllers', [])
  .controller('HomeController', ['$scope', function($scope) {

  }])
  .controller('CreateAccountController', ['$scope','$http', function($scope, $http) {
  	$scope.activeCreate = true;
 	$scope.activeSuccess = false;
 	
	$scope.createAccount = function(account) {
		/* Call to PHP Service to insert into account */
		$scope.preproc = account;
		 
		$http.post('backend/createAccountService.php', account).
			success(function(data, status){
				$scope.data = data;
				$scope.status = status;
				
				if(data["message"] == "success"){
					$scope.activeCreate = false;
 					$scope.activeSuccess = true;
				}
			}).
			error(function(data, status){
				$scope.data = data;
				$scope.status = status;				
			});
	};
  }])
  .controller('MembershipController', ['$scope', function($scope) {

  }]);
