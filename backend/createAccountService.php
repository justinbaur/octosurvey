<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		$account = json_decode($_POST["data"], true);
		$username = $account['username'];
		$password = $account['password'];
		
		$arr = array ('echo_username'=>$username,'echo_password'=>$password, 'echo_test'=>27);
		echo json_encode($arr);
	}
?>
