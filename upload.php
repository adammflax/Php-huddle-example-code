<?php session_start();
	require_once ('Oauth2Lib/Client.php');
	require_once ('Oauth2Lib//GrantType/IGrantType.php');
	require_once ('Oauth2Lib/GrantType/AuthorizationCode.php');
	require_once ('huddleApi.php');
	require_once ('folder.php');
	require_once ('document.php');
	
	const _CLIENT_ID = 'foo';
	const _CLIENT_SECRET = '';
	const _HUDDLE_AUTH_SERVER = 'foo';
	const _REDIRECT_URI = 'foo';
	const _AUTHORIZATION_ENDPOINT = 'foo';
	const _TOKEN_ENDPOINT = 'foo';

	$client = new OAuth2\Client(_CLIENT_ID, _CLIENT_SECRET);
	
	if (isset($_SESSION['code'])) {
		if ($_FILES["content"]["error"] == 0)
		{
			$code = $_SESSION['code'];
			$params = array('code' => $code, 'redirect_uri' => _REDIRECT_URI);
			$getToken = $client -> getAccessToken(_TOKEN_ENDPOINT, 'authorization_code', $params);
			$token = $getToken['result'];
		
			//now we can do some api calls
			$api = new huddleApi(_HUDDLE_AUTH_SERVER, $token['access_token']);
		
			$folder = $api -> getFolder("http://api.huddle.dev/files/folders/1237980/");
			$document = $api -> createDocument($folder -> getLinkWithRel("create-document"), "foo", "bar");
		
			$api -> uploadDocument($document -> getLinkWithRel("upload"));
		}
	}
?>
