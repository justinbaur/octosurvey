<!DOCTYPE html>
<?php session_start(); ?>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="octosurvey" class="no-js"> <!--<![endif]-->
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
	<div class="header">
		<img id="logo" ng-src="" />
	</div>
	<?php 
		$alreadyLogged = false;
		$correctlyLogged = false;
		$status = "";
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			#Create Account 
			if(isset($_POST["createaccount"])){
				if(isset($_POST["username"]) and $_POST["password"] == $_POST["confirmpassword"]{
					$status = "Created Account!";
				}	
			}
			
			#Login
			if($_SESSION["valid"] == true){
				$alreadyLogged = true;
			}else if($_POST["username"] == "Justin" and $_POST["password"] == "Baur"){
				$correctlyLogged = true;
				$alreadyLogged = true;
				$_SESSION["valid"] == true;
				$status = "Welcome, " . $_POST["username"];
			}
		}

	?>
	
	<div id="statusbox">
		Status: <?= $status ?>
	</div>
	
	<?php
		
		if($correctlyLogged == true || $alreadyLogged == true){
	?>
		<a href="partials/logout.php" id="logoutButton">Logout</a>
		<ul class="menu">
		    <li><a href="#/">Home</a></li>
		    <li><a href="#/Membership">Become A Member</a></li>
		    <li><a href="#/Support">Support</a></li>
		    <li><a href="#/About">About Us</a></li>    
		</ul>
	
	  <!--[if lt IE 7]>
	      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	  <![endif]-->
		<div ng-view></div>
	<?php } else{?>
		<ul class="menu">
		    <li><a href="#/">Home</a></li>
		    <li><a href="#/Create">Create Account</a></li>
		    <li><a href="#/Member">Become A Member</a></li>
		    <li><a href="#/Support">Support</a></li>
		    <li><a href="#/About">About Us</a></li>    
		</ul>
		
		<?php include("partials/authentication.html"); ?> 
		<div ng-view></div>
	<?php } ?>
</body>
</html>
