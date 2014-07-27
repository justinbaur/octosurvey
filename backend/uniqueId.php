<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$arr = array ('isUnique'=>true);
		echo json_encode($arr);
	}
	
?>
