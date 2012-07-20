<?php
include_once ('user.php');

class huddleApi {
	private $HuddleAuthServer = "";
	private $access_token = "";

	public function __construct($HuddleAuthServer, $access_token) {
		$this -> access_token = $access_token;
		$this -> HuddleAuthServer = $HuddleAuthServer;
	}

	public function getUser() {
		$url = "http://api.huddle.dev/entry/";
		$headers = array('Authorization : OAuth2' . $this -> access_token, 'Accept: application/json');
		$options = array(CURLOPT_URL => $url, CURLOPT_PROXY => '127.0.0.1:8888', CURLOPT_RETURNTRANSFER => 1, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_HEADER => 1, CURLOPT_HTTPHEADER => $headers);

		$ch = curl_init() or die(curl_error());
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);

		curl_close($ch);

		$result = preg_replace('/^[^{]+/', '', $result);
		#removed BOM

		$user = new user($result);
		return $user;

	}
}
?>