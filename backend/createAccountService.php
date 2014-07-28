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

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$account = json_decode(file_get_contents('php://input'), true);
		$username = pg_escape_string($account['username']);
		$password = pg_escape_string($account['password']);
		$email = pg_escape_string($account['email']);
		
		$conn = databaseConnect();
		
		$insert = "INSERT INTO accounts VALUES('".$email."','".$username."','".$password."');";
		
		pg_query($insert) or die('Insert Failed' . pg_last_error());
		
		$select = 'SELECT * FROM accounts;';
		
		$result = pg_query($select) or die("select failed" . pg_last_error());
		
		$line = pg_fetch_array($result, null, PGSQL_ASSOC);
		
		pg_free_result($result);
		pg_close($conn);
		
		echo json_encode($line);
	}
?>
