<html>
<head>
<title>Send Email</title>
</head>
<body>
<?php
	$url = 'https://api.sendgrid.com/';
	$options = array(
	    'api_user'  => 'octosurvey',
	    'api_key'   => 'octosurveytest',
	    'to'        => 'silverhat@live.com',
	    'subject'   => 'Testing Send Grid API',
	    'html'      => 'Hello, World!',
	    'text'      => 'This is a test.',
	    'from'      => 'no-reply@octosurvey.com',
	  );

	$request = $url.'api/mail.send.json';
	$session = curl_init($request);
	// Tell curl to use HTTP POST
	curl_setopt ($session, CURLOPT_POST, true);
	// Tell curl that this is the body of the POST
	curl_setopt ($session, CURLOPT_POSTFIELDS, $options);
	// Tell curl not to return headers, but do return the response
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

	// obtain response
	$response = curl_exec($session);
	curl_close($session);

	// print everything out
	print_r($response);
?>

<p>Hello, World!</p>
</body>
</html>
