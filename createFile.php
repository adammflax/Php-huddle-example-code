<html>
<?php
	session_start();
	require_once('Oauth2Lib/Client.php');
	require_once('Oauth2Lib//GrantType/IGrantType.php');
	require_once('Oauth2Lib/GrantType/AuthorizationCode.php');
	require_once('huddleApi.php');
	require_once('folder.php');
	require_once('document.php');
	
	
	const _CLIENT_ID     = 'foo'; 
	const _CLIENT_SECRET = '';
	const _HUDDLE_AUTH_SERVER = 'foo';
	const _REDIRECT_URI           = 'foo';
	const _AUTHORIZATION_ENDPOINT = 'foo';
	const _TOKEN_ENDPOINT         = 'foo';
	?>
	<head></head>
	<body>
		<?php
		$client = new OAuth2\Client(_CLIENT_ID, _CLIENT_SECRET);
		
		if(!isset($_SESSION['code']))
		{
		
		    $auth_url = $client->getAuthenticationUrl(_AUTHORIZATION_ENDPOINT, _REDIRECT_URI);
			header('Location: ' . $auth_url);
		    die('Redirect');
		}
		?>		
		<form action="upload.php" method="post"enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="content" id="file" /> 
			<br />
			<input type="submit" name="submit" value="Submit" />
		</form>
</html>
