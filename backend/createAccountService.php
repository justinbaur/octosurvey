<?php
	require 'vendor/autoload.php';

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


	function sendVerificationEmail($to, $from, $fromName, $subject, $body){		
		$sendgrid = new SendGrid('octosurvey', 'octosurveytest', array("turn_off_ssl_verification" => true));
	
		$email = new SendGrid\Email();
		$email->addTo($to)->
		       setFrom($from)->
		       setFromName($fromName)->
		       setSubject($subject)->
		       setText($body);
		$response = $sendgrid->send($email);
		
		
		return $response;
	}

	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		#$account = json_decode(file_get_contents('php://input'), true);
		#$username = pg_escape_string($account['username']);
		#$password = pg_escape_string($account['password']);
		#$email = pg_escape_string($account['email']);
		
		#$conn = databaseConnect();
		
		#$insert = "INSERT INTO accounts VALUES('".$email."','".$username."','".$password."');";
		
		#pg_query($insert) or die('Insert Failed' . pg_last_error());
		
		$re = sendVerificationEmail("silverhat@live.com", "no-reply@octosurvey", "OctoSurvey", "Sign-Up Verification", "Test");
		
		#$select = 'SELECT * FROM accounts;';
		
		#$result = pg_query($select) or die("select failed" . pg_last_error());
		
		#$line = pg_fetch_array($result, null, PGSQL_ASSOC);
		
		#pg_free_result($result);
		#pg_close($conn);
		echo $re;
		#echo json_encode($line);
	}
?>
