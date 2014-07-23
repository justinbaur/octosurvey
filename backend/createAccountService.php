<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$account = $_POST["account"];
		echo $account;
	}
?>
