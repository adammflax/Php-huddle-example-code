<?php
session_start();
require_once('Oauth2Lib/Client.php');
require_once('Oauth2Lib//GrantType/IGrantType.php');
require_once('Oauth2Lib/GrantType/AuthorizationCode.php');
require_once('huddleApi.php');


const _CLIENT_ID     = 'adam-redirect-flow'; 
const _CLIENT_SECRET = '';
const _HUDDLE_AUTH_SERVER = 'http://api.huddle.dev/';
const _REDIRECT_URI           = 'http://127.0.0.1:8181/auth/callback';
const _AUTHORIZATION_ENDPOINT = 'http://login.huddle.dev/request/';
const _TOKEN_ENDPOINT         = 'http://login.huddle.dev/token/';

$client = new OAuth2\Client(_CLIENT_ID, _CLIENT_SECRET);

if(!isset($_SESSION['code']))
{

    $auth_url = $client->getAuthenticationUrl(_AUTHORIZATION_ENDPOINT, _REDIRECT_URI);
	header('Location: ' . $auth_url);
    die('Redirect');
}
else
{
	$code =  $_SESSION['code'];
	$params = array('code' => $code, 'redirect_uri' => _REDIRECT_URI);
	$getToken = $client ->getAccessToken(_TOKEN_ENDPOINT, 'authorization_code', $params);
	$token = $getToken['result'];
	
	//now we can do some api calls
	$api = new huddleApi(_HUDDLE_AUTH_SERVER, $token['access_token']);
	
	$user = $api->getUser();
	echo "You currently have ".$user->getWorkSpaceCount()." workspaces!";
	for($i = 0; $i < $user->getWorkSpaceCount(); $i++)
	{
		echo "<p> Workspace: ".$user->getWorkSpaceTitle($i)." has the following links: ";
		for($x = 0; $x < $user->getWorkSpaceLinksCount($i); $x++)
		{
			echo "</br>".$user->getWorkSpaceLinkRel($i, $x)." ".$user->getWorkSpaceLinkHref($i, $x);
		}
	}
}

?>		
<form method="post" enctype="multipart/form-data" action="URLHERE!PUT" >
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file" /> 
	<br />
	<input type="submit" name="submit" value="Submit" />
</form>
		
<?php
	if (isset($_FILES["file"]["error"]))
	{
		echo $_FILES["file"]["name"];
	}
?>
