<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$account = json_decode(file_get_contents('php://input'), true);
		$username = pg_escape_string($account['username']);
		$password = pg_escape_string($account['password']);
		$email = pg_escape_string($account['email']);
		
		$dbUrl = parse_url($_ENV['DATABASE_URL']);

		$dbHost = $dbUrl['host'];
		$dbPort = $dbUrl['port'];
		$dbName = ltrim($dbUrl['path'], "/");
		$dbUser	= $dbUrl['user'];
		$dbPass = $dbUrl['pass'];
		
		$connection = "host=".$dbHost." port=".$dbPort." dbname=".$dbName." user=".$dbUser." password=".$dbPass." sslmode=require";
		
		$db = pg_connect($connection) or die('Could not connect: ' . pg_last_error());
			
		$createTable = 
			'CREATE TABLE accounts (
			email varchar(40) CONSTRAINT firstkey PRIMARY KEY,
			username varchar(20) NOT NULL,
			password varchar(20) NOT NULL
			);';
		pg_query($createTable) or die('create Failed' .pg_last_error());
		
		$insert = "INSERT INTO accounts VALUES('".$email."','".$username."','".$password."');";
		
		pg_query($insert) or die('Insert Failed' . pg_last_error());
		
		$select = 'SELECT * FROM accounts;';
		
		$result = pg_query($select) or die("select failed" . pg_last_error());
		
		$line = pg_fetch_array($result, null, PGSQL_ASSOC);
		
		pg_free_result($result);
		pg_close($db);
		
		/* E-mail Config 
		$to = $username;
		$subject = 'OctoSurvey Signup | Verification';
		$message = '
		
		Thanks for signing up for OctoSurvey!
		Your account has been created, you can login with the following credentials after you have activated your account via the URL.
		
		-----------------------
		Username: '.$username.'
		Password: '.$password.'
		
		
		Please click the following link to activate your account:
		https://octosurvey.herokuapp.com/verify.php?email='.$username.'&hash='.$hash.'
		
		';
		
		$headers = 'From:noreply@octosurvey.herokuapp.com' . "\r\n";
		mail($to, $subject, $message, $headers);
		*/
		
		#$arr = array ('con'=>$connection);
		echo json_encode($line);
	}
?>
