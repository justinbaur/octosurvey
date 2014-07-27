<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$account = json_decode(file_get_contents('php://input'), true);
		$username = pg_escape_string($account['username']);
		$password = pg_escape_string($account['password']);
		
		$dbUrl = parse_url($_ENV['DATABASE_URL']);
		
		#$connectionString = "host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 dbname=da113aib43h35h user=fbktfkddiceiux password=i3Xxbg_bH2bUOPy1EPJ1rT4PtH sslmode=require";

		$dbHost = $dbUrl['host'];
		$dbPort = $dbUrl['port'];
		$dbName = $dbUrl['path'];
		$dbUser	= $dbUrl['user'];
		$dbPass = $dbUrl['pass'];
		
		$db = pg_connect("host='.$dbHost.' port='.$dbPort.' dbname='.$dbName.' user='.$dbUser.' password='.$dbPass.' sslmode=require") or die('Could not connect: ' . pg_last_error());
			
		
		
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
		
		$arr = array ('echo_username'=>$username,'echo_password'=>$password, 'echo_test'=>27, 'dbconfig'=>$_ENV['DATABASE_URL']);
		echo json_encode($arr);
	}
?>
