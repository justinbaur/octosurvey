<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		$account = json_decode(file_get_contents('php://input'), true);
		$username = $account['username'];
		$password = $account['password'];
		
		$arr = array ('echo_username'=>$username,'echo_password'=>$password, 'echo_test'=>27);
		echo json_encode($arr);
	}
?>
