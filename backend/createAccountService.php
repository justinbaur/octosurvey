<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$confirmpassword = $_POST["confirm_password"];
			
		$arr = array ('echo_username'=>$username,'echo_password'=>$password, 'echo_confirmpassword'=>$confirmpassword);
		echo json_encode($arr);
	}
?>
