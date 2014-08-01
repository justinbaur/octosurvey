<?php
	function symmetricEncryption($plain){
		$key_size = mcrypt_get_key_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
		$encryption_key = openssl_random_pseudo_bytes($key_size, $isStrong);
		
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
		
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $encryption_key, $plain, MCRYPT_MODE_CFB, $iv);
	}
	
	function symmetricDecryption($encrypted, $iv){
		return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $encryption_key, $encrypted, MCRYPT_MODE_CFB, $iv);
	}
	
	function hashEncryption($password){
		return password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
	}
?>
