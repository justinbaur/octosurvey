<html>
<head>
<title>Send Email</title>
</head>
<body>
<?
	require('vendor/autoload.php');

	$sendgrid = new SendGrid('octosurvey', 'octosurveytest', array("turn_off_ssl_verification" => true));

	$email = new SendGrid\Email();
	$email->addTo("silverhat@live.com")->
	       setFrom("no-reply@octosurvey.com")->
	       setSubject("Verification Email")->
	       setText("Test");
	$response = $sendgrid->send($email);
	
	var_dump($response);
?>

<p>Hello, World!</p>
</body>
</html>
