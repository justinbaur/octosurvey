<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" ng-app="octosurvey" class="no-js">
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
	<h1>SendGrid</h1>
	<?php 
		$alreadyLogged = false;
		$correctlyLogged = false;
		$status = "";
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){		
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
		<a href="logout.php" id="logoutButton">Logout</a>
		
		<ul class="menu">
		    <li><a href="#/">Home</a></li>
		    <li><a href="#/Membership">Become A Member</a></li>
		    <li><a href="#/Support">Support</a></li>
		    <li><a href="#/About">About Us</a></li>    
		</ul>
	
		<div ng-view></div>
	<?php } else{ ?>
		<ul class="menu">
		    <li><a href="#/">Home</a></li>
		    <li><a href="#/CreateAccount">Create Account</a></li>
		    <li><a href="#/Membership">Become A Member</a></li>
		    <li><a href="#/Support">Support</a></li>
		    <li><a href="#/About">About Us</a></li>    
		</ul>
		
		<?php include("view/authentication.html"); ?> 
		<div ng-view></div>
	<?php } ?>
</body>
</html>
