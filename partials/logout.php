<!DOCTYPE html>
<?php session_destroy(); ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OctoSurvey</title>
  <meta name="description" content="OctoSurvey provides reliable content delivered as surveys you create as a social experience.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- <link rel="stylesheet" href="bower_components/html5-boilerplate/css/normalize.css">
  <link rel="stylesheet" href="bower_components/html5-boilerplate/css/main.css">

  <script src="bower_components/html5-boilerplate/js/vendor/modernizr-2.6.2.min.js"></script>
   In production use:
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/x.x.x/angular.min.js"></script>
  -->
  <link rel="stylesheet" href="css/app.css"/>
  <script src="lib/angular/angular.js"></script>
  <script src="lib/angular-route/angular-route.js"></script>
  <script src="js/app.js"></script>
  <script src="js/services.js"></script>
  <script src="js/controllers.js"></script>
  <script src="js/filters.js"></script>
  <script src="js/directives.js"></script>
</head>
<body>
	<p>Successfully Logged Out!</p>
	<ul class="menu">
	    <li><a href="/">Home</a></li>
	    <li><a href="/Create">Create Account</a></li>
	    <li><a href="/Member">Become A Member</a></li>
	    <li><a href="/Support">Support</a></li>
	    <li><a href="/About">About Us</a></li>    
	</ul>
	<div ng-view></div>
</body>
</html>
