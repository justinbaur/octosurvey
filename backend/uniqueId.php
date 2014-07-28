<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{		
		$username = json_decode(file_get_contents('php://input'), true);
		
		$dbUrl = parse_url($_ENV['DATABASE_URL']);

		$dbHost = $dbUrl['host'];
		$dbPort = $dbUrl['port'];
		$dbName = ltrim($dbUrl['path'], "/");
		$dbUser	= $dbUrl['user'];
		$dbPass = $dbUrl['pass'];
		
		$connection = "host=".$dbHost." port=".$dbPort." dbname=".$dbName." user=".$dbUser." password=".$dbPass." sslmode=require";
		
		$db = pg_connect($connection) or die('Could not connect: ' . pg_last_error());
				
		$select = "SELECT username FROM accounts WHERE username='".$username."';";
		
		$result = pg_query($select) or die("select failed" . pg_last_error());
		
		$line = pg_fetch_array($result, null, PGSQL_ASSOC);
		
		pg_free_result($result);
		pg_close($db);
		
		if($line){
			$arr = array ('isUnique'=>false);
			echo json_encode($arr);
		}else{
			$arr = array ('isUnique'=>true);
			echo json_encode($arr);
		}

	}
?>
