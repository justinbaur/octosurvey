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


	function sendVerificationEmail($to, $from, $subject, $body){		
		$url = 'https://api.sendgrid.com/';
		$options = array(
		    'api_user'  => $_ENV['SENDGRID_USERNAME'],
		    'api_key'   => $_ENV['SENDGRID_KEY'],
		    'to'        => $to,
		    'subject'   => $subject,
		    'html'      => $body,
		    'from'      => $from
		  );

		$request = $url.'api/mail.send.json';
		$session = curl_init($request);

		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $options);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($session);
		curl_close($session);
		
		return $response;
	}

	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$account = json_decode(file_get_contents('php://input'), true);
		
		$username = pg_escape_string($account['username']);
		$password = pg_escape_string($account['password']);
		$email = pg_escape_string($account['email']);
		
		$hash = md5( rand(0, 1000) );
		
		$conn = databaseConnect();

		$escapedPassword = pg_escape_bytea(hashEncryption($password));
		 
		$insert = "INSERT INTO accounts VALUES('".$email."','".$username."','".$escapedPassword."','".$hash."',FALSE);";
		
		pg_query($insert) or die('Insert Failed' . pg_last_error());
		
		$activateUrl = "https://octosurvey.herokuapp.com/verify.php?email=".$email."&hash=".$hash;
		
		$response = sendVerificationEmail(
			$email, 
			"no-reply@octosurvey.com", 
			"OctoSurvey Account Verification", 
			"Hello " . $username . ", Thank you for signing up!
			
			<br/>
			<br/>
			
			Your account has been created, please click the following link to activate your account.
			
			<br/>
			
			<a href='".$activateUrl."'>Activate your Account!</a>
			
			");
		
		pg_close($conn);
		
		echo json_encode($response);
	}
?>
