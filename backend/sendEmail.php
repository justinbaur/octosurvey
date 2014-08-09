<html>
<head>
<title>Send Email</title>
</head>
<body>
<?
	require('vendor/autoload.php');

	$options = array(
	  'turn_off_ssl_verification' => false,
	  'protocol' => 'https',
	  'host' => 'api.sendgrid.com',
	  'endpoint' => '/api/mail.send.json',
	  'port' => null,
	  'url' => null
	);

	$sendgrid = new SendGrid('octosurvey', 'octosurveytest', $options);

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
