'use strict';

/* Directives */


angular.module('octosurvey.directives', []).directive('uniqueid', function($http){
	return {
		require: 'ngModel',
		link: function(scope, ele, attrs, c){
			scope.$watch(attrs.ngModel, function(){
				$http({
					method: 'POST',
					url:	'backend/uniqueId',
					data: {'field': attrs.uniqueid}
				}).success(function(data, status, headers, cfg){
					c.$setValidity('unique', data.isUnique);
				}).error(function(data, status, headers, cfg){
					c.$setValidity('unique', false);
				});
			});
		}
	}
}).directive('passwordformvalidation', function() {
  return {
    restrict: 'A', // only activate on element attribute
    require: '?ngModel', // get a hold of NgModelController
    link: function(scope, elem, attrs, ngModel) {
      if(!ngModel) return; // do nothing if no ng-model

      // watch own value and re-validate on change
      scope.$watch(attrs.ngModel, function() {
        scope.passwordvalidation = validate();
      });

      // observe the other value and re-validate on change
      attrs.$observe('passwordformvalidation', function (val) {
        scope.passwordvalidation = validate();
      });

      var validate = function() {
        // values
        var val1 = ngModel.$viewValue;
        var val2 = attrs.passwordformvalidation;
	var validPassword = true;
	var res = "";
	
	if(val1 !== val2){
	  validPassword = false;
	  res += " Passwords do not match! ";
	}
	
	if(val2.length < 6){
	  validPassword = false;
	  res += " Password needs to be longer then 6 characters! ";
	}
	
	if(val2.length >= 16){
	  validPassword = false;
	  res += " Password needs to be shorter then 16 characters! ";
	}	
	
        // set validity
        ngModel.$setValidity('passwordvalidationflag', validPassword);
        return res;
      };
    }
  };
});
