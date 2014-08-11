<html>
<head>
</head>
<body>
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
	
	$conn = databaseConnect();
	
	$select = "SELECT password FROM accounts WHERE username='Justin';";
		
	$result = pg_query($select) or die("select failed" . pg_last_error());
	
	$raw = pg_fetch_array($result, null, PGSQL_ASSOC);	
	
	$unescaped = pg_unescape_bytea($raw["password"]);
	
	$answer = "????";
	
	if(password_verify("justin", $unescaped)){
		$answer = "true";
	}else{
		$answer = "false";
	}
	
	pg_free_result($result);

	pg_close($conn);
	
	echo '<p>'.$unescaped.'</p><p>'.$answer.'</p>';
?>
</body>
</html>
