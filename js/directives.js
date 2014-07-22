'use strict';

/* Directives */


angular.module('octosurvey.directives', []).
  directive('appVersion', ['version', function(version) {
    return function(scope, elm, attrs) {
      elm.text(version);
    };
  }])
.directive('formValidation', function() {
  return {
    restrict: 'A', // only activate on element attribute
    require: '?ngModel', // get a hold of NgModelController
    link: function(scope, elem, attrs, ngModel) {
      if(!ngModel) return; // do nothing if no ng-model

      // watch own value and re-validate on change
      scope.$watch(attrs.ngModel, function() {
      	var res = "";
        res = res + validate();
        res = res + maxLength();
        res = res + minLength();
        
        if(res.length > 0){
           ngModel.$setValidity('validation', false);
        }else{
    	   ngModel.$setValidity('validation', true);
        }
        $scope.passwordValidation = res;
      });

      // observe the other value and re-validate on change
      attrs.$observe('validation', function (val) {
        var res = "";
        res = res + validate();
        res = res + maxLength();
        res = res + minLength();
        
        if(res.length > 0){
           ngModel.$setValidity('validation', false);
        }else{
    	   ngModel.$setValidity('validation', true);
        }
        $scope.passwordValidation = res;
      });

      var validate = function() {
        // values
        var val1 = ngModel.$viewValue;
        var val2 = attrs.equals;

	var resMessage = "";
	
        // set validity
        if(val1 != val2){
          resMessage = "<p>Passwords do not match</p>";
        }
        
	return resMessage;
      };
      
      var maxLength = function() {
      	var val1 = ngModel.$viewValue;
      	var resMessage = "";
      	
      	if(val1.length <= 6){
           resMssage = "<p>Password requires length of 6</p>";
      	}
      	
   	return resMessage;
      };
      
      var minLength = function() {
      	var val1 = ngModel.$viewValue;
      	var resMessage = "";
      	
      	if(val1.length >= 16){
           resMessage = "<p>Password max length of 16</p>";
      	}
      	
   	return resMessage;
      };
    }
  }
