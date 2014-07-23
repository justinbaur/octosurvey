<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$account = $_POST["account"];
		$data = $_POST["data"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$confirmpassword = $_POST["confirm_password"];
		
		$arr = array ('echo_account'=>$account, 'echo_data'=>$data, 'echo_username'=>$username,'echo_password'=>$password, 'echo_confirmpassword'=>$confirmpassword, 'echo_test'=>27);
		echo json_encode($arr);
	}
?>
