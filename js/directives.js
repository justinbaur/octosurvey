'use strict';

/* Directives */


angular.module('octosurvey.directives', []).
  directive('appVersion', ['version', function(version) {
    return function(scope, elm, attrs) {
      elm.text(version);
    };
  }])
.directive('passwordFormValidation', function() {
  return {
    restrict: 'A', // only activate on element attribute
    require: '?ngModel', // get a hold of NgModelController
    link: function(scope, elem, attrs, ngModel) {
      if(!ngModel) return; // do nothing if no ng-model

      // watch own value and re-validate on change
      scope.$watch(attrs.ngModel, function() {
        scope.passwordValidation = validate();
      });

      // observe the other value and re-validate on change
      attrs.$observe('passwordFormValidation', function (val) {
        scope.passwordValidation = validate();
      });

      var validate = function() {
        // values
        var val1 = ngModel.$viewValue;
        var val2 = attrs.passwordFormValidation;
	var validPassword = true;
	
	if(val1 !== val2){
	  validPassword = false;
	  res += " Passwords do not match! ";
	}
	
	if(val1.length < 6){
	  validPassword = false;
	  res += " Password needs to be longer then 6 characters! ";
	}
	
	if(val1.length >= 16){
	  validPassword = false;
	  res += " Password needs to be shorter then 16 characters! ";
	}	
	
        // set validity
        ngModel.$setValidity('passwordValidationFlag', validPassword);
        return res;
      };
    }
  };
});
