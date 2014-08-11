<!DOCTYPE html>
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
		<ul class="menu">
		    <li><a href="https://octosurvey.herokuapp.com">Home</a></li>
		    <li><a href="https://octosurvey.herokuapp.com/#/CreateAccount">Create Account</a></li>
		    <li><a href="https://octosurvey.herokuapp.com/#/Membership">Become A Member</a></li>
		    <li><a href="https://octosurvey.herokuapp.com/#/Support">Support</a></li>
		    <li><a href="https://octosurvey.herokuapp.com/#/About">About Us</a></li>    
		</ul>
		
	<div id="">
<?php
	function databaseConnect(){
		$dbUrl = parse_url($_ENV['DATABASE_URL']);

		$dbHost = $dbUrl['host'];
		$dbPort = $dbUrl['port'];
		$dbName = ltrim($dbUrl['path'], "/");
		$dbUser	= $dbUrl['user'];
		$dbPass = $dbUrl['pass'];
		
		$connection = "host=".$dbHost." port=".$dbPort." dbname=".$dbName." user=".$dbUser." password=".$dbPass." sslmode=require";
		
		$db = pg_connect($connection) or die('Could not connect: ' . pg_last_error());
		
		return $db;
	}
	
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
		$email = pg_escape_string($_GET['email']);
		$hash = pg_escape_string($_GET['hash']);
		$verified = false;

		$conn = databaseConnect();

		$select = "SELECT username FROM accounts WHERE email='".$email."' AND hash='".$hash."' AND active=FALSE ;";
		
		$result = pg_query($select) or die("select failed" . pg_last_error());
				
		if(pg_num_rows($result) > 0){
			$verified = true;
			$update = "UPDATE accounts SET active=TRUE WHERE email='".$email."' AND hash='".$hash."';";
			pg_query($update);
			echo '<div id="verificationStatus">Account Verified!  Your account is now ready to use.</div>';
		}else{
			echo '<div id="verificationStatus">Invalid Verification, we could not verify your account with the provided email.  Please contact customer support.</div>';		
		}
		
		pg_free_result($result);
		pg_close($conn);
	}else{
		echo '<div id="verificationStatus">Invalid Verification, please use the link provided in your account verification email.</div>';	
	}
	
	
?>
	</div>
</body>
</html>