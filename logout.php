<!DOCTYPE html>
<?php session_destroy(); ?>
<html lang="en" ng-app="octosurvey" class="no-js">
<head>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OctoSurvey</title>
  <meta name="description" content="OctoSurvey provides reliable content delivered as surveys you create as a social experience.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
	<div class="header">
		<img id="logo" ng-src="img/OctoBanner.jpg" />
	</div>
	
	<p>Successfully Logged Out!</p>
	<ul class="menu">
	    <li><a href="index.php">Home</a></li>
	    <li><a href="#/DistributorRegistration">Register as a survey distributor</a></li>
	    <li><a href="#/Membership">Become A Member</a></li>
	    <li><a href="#/Support">Support</a></li>
	    <li><a href="#/About">About Us</a></li>    
	</ul>
	<div ng-view></div>
</body>
</html>
