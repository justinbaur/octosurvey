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
		$input = json_decode(file_get_contents('php://input'), true);
		$username = $input['field'];

		$conn = databaseConnect();	
					
		$select = "SELECT username FROM Accounts WHERE username='".$username."';";
		
		$result = pg_query($select) or die("select failed" . pg_last_error());
		
		$line = pg_fetch_array($result, null, PGSQL_ASSOC);
		
		if($line){
			$arr = array ('user'=>$username,'query'=>$select,'result'=>$line,'isUnique'=>false);
			echo json_encode($arr);
		}else{
			$arr = array ('user'=>$username,'query'=>$select,'result'=>$line,'isUnique'=>true);
			echo json_encode($arr);
		}

		pg_free_result($result);
		pg_close($conn);
	}
?>
