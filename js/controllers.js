'use strict';

/* Controllers */

angular.module('octosurvey.controllers', [])
  .controller('HomeController', ['$scope', function($scope) {

  }])
  .controller('CreateAccountController', ['$scope','$http', function($scope, $http) {
  	
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
 					$scope.creationResponse = "Thank you for creating an account with OctoSurvey, please check your E-mail for verification.";
 					$scope.$apply();
				}else{
					$scope.activeCreate = false;
 					$scope.activeSuccess = true; 		
					$scope.creationResponse = "There was a problem creating your account.";			
					$scope.$apply();
				}
			}).
			error(function(data, status){
				$scope.data = data;
				$scope.status = status;	
				$scope.activeCreate = false;
 				$scope.activeSuccess = true; 	
				$scope.creationResponse = "There was a problem creating your account.";	
				$scope.$apply();					
			});
	};
  }])
  .controller('MembershipController', ['$scope', function($scope) {

  }]);
