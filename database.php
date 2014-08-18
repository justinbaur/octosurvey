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
	
	$q = "DROP TABLE accounts;";	
	pg_query($q) or die('drop Failed' . pg_last_error());
		
	$a = 'CREATE TABLE Accounts (
			id integer SERIAL PRIMARY KEY,
			username varchar(40) NOT NULL,
			password bytea NOT NULL,
			email varchar(40),
			role varchar(40) NOT NULL
			hash varchar(40),
			active boolean NOT NULL						
		);';
	pg_query($a) or die('create Failed' .pg_last_error());
	
	$q = 'CREATE TABLE Member (
			id integer references accounts(id),
			companyname varchar(40) NOT NULL,
			phone varchar(40),
			address varchar(40),
			country varchar(40),
			city varchar(40),
			description varchar(255),
			options varchar(40)	
			joined timestamp			
		);';
	pg_query($q) or die('create Failed' .pg_last_error());
	
	$q = 'CREATE TABLE Distributor (
			id integer references accounts(id),
			verified boolean NOT NULL,			
			firstname varchar(40) NOT NULL,
			lastname varchar(40) NOT NULL,			
			middlename varchar(40),		
			gender varchar(6),
			age integer,
			race varchar(40),	
			phone varchar(40),
			address varchar(40),
			country varchar(40),
			city varchar(40),
			interests varchar(255)
			joined timestamp
		);';
	pg_query($q) or die('create Failed' .pg_last_error());
	
	$insert = "INSERT INTO Accounts VALUES('Justin','Justin','Admin',TRUE);";
		
	pg_query($insert) or die('Insert Failed' . pg_last_error());

?>
</body>
</html>
