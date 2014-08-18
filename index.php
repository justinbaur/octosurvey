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
	<?php 
		include 'encryption_module.php';
	
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
	
		$correctlyLogged = false;
		$status = "";
		$role = "";
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){		
			#Login
			if($_SESSION["valid"] == true){
				$correctlyLogged = true;
			}else{
				$user = pg_escape_string($_POST["username"]);
				$pass = pg_escape_string($_POST["password"]);
				
				$conn = databaseConnect();
				
				$select = "SELECT role, password, active FROM Accounts WHERE username='".$user."';";
		
				$result = pg_query($select) or die("select failed" . pg_last_error());

				if(pg_num_rows($result) > 0){
					$line = pg_fetch_array($result, null, PGSQL_ASSOC);		
					echo $line["active"] . ":" . pg_unescape_bytea($line["password"]);		
					#if($line["active"] == "FALSE"){
					#	$_SESSION["valid"] = false;	
					#	$status = "Sorry, Your account has not been activated yet.";
					#}else{	
					#	if(hashEncryption($pass) == pg_unescape_bytea($line["password"])){
					#		$correctlyLogged = true;
					#		$_SESSION["valid"] = true;
					#		
					#		$role = $line["role"];
					#		$status = "Welcome, " . $_POST["username"];
					#	}else{
					#		$_SESSION["valid"] = false;	
					#		$status = "Sorry, The password you provided is invalid";				
					#	}
					#}
				}else{
					$_SESSION["valid"] = false;					
					$status = "Sorry, Could not find the username you provided.";				
				}
				
				pg_free_result($result);

			}
		}
	?>
	
	<div id="statusbox">
		Status: <?= $status ?>
	</div>
	<?php	
		if($correctlyLogged == true){ 
			if($role == "Distributor"){
	?>	
			<ul class="menu">
			    <li><a href="#/">Home</a></li>
			    <li><a href="#/SurveyOffers">Survey Offers</a></li>			    
			    <li><a href="#/Support">Support</a></li>
			    <li><a href="#/About">About Us</a></li>    
			</ul>

		<?php 	} else if($role == "Member"){ ?>
			<ul class="menu">
			    <li><a href="#/">Home</a></li>
			    <li><a href="#/MemberProfile">Member Profile</a></li>
			    <li><a href="#/MemberSurveys">Surveys</a></li>
			    <li><a href="#/Support">Support</a></li>
			    <li><a href="#/About">About Us</a></li>    
			</ul>
		<?php 	} else{ ?>	
			<ul class="menu">
			    <li><a href="#/">Home</a></li>
			    <li><a href="#/Support">Support</a></li>
			    <li><a href="#/About">About Us</a></li>    
			</ul>
		<?php 	} ?>
			<a href="logout.php" id="logoutButton">Logout</a>
	<?php 	} else{ ?>
			<ul class="menu">
			    <li><a href="#/">Home</a></li>
			    <li><a href="#/DistributorRegistration">Register as a survey distributor</a></li>
			    <li><a href="#/Membership">Become A Member</a></li>
			    <li><a href="#/Support">Support</a></li>
			    <li><a href="#/About">About Us</a></li>    
			</ul>
		
			<?php include("view/authentication.html"); ?> 
	<?php 	} ?>
	
	<div ng-view></div>
</body>
</html>
