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

	$q = "DROP TABLE accounts;";	
	pg_query($q) or die('drop Failed' . pg_last_error());
		
	$q = 'CREATE TABLE accounts (
			email varchar(40) CONSTRAINT firstkey PRIMARY KEY,
			username varchar(40) NOT NULL,
			password bytea NOT NULL,
			hash varchar(40) NOT NULL,
			active boolean NOT NULL,
			iv bytea
			);';
	pg_query($q) or die('create Failed' .pg_last_error());
	pg_close($conn);
?>
