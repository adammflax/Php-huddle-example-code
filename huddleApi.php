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
		$headers = array('Authorization : OAuth2' ." ". $this -> access_token, 'Accept: application/json');
		$options = array(CURLOPT_URL => $url, CURLOPT_PROXY => '127.0.0.1:8888', CURLOPT_RETURNTRANSFER => 1, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_HEADER => 1, CURLOPT_HTTPHEADER => $headers);

		$ch = curl_init() or die(curl_error());
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);

		curl_close($ch);

		$result = preg_replace('/^[^{]+/', '', $result); #removed BOM

		$user = new user($result);
		return $user;

	}
	
	public function getFolder($url) {
		$headers = array('Authorization : OAuth2' ." ". $this -> access_token, 'Accept: application/json');
		$options = array(CURLOPT_URL => $url, CURLOPT_PROXY => '127.0.0.1:8888', CURLOPT_RETURNTRANSFER => 1, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_HEADER => 1, CURLOPT_HTTPHEADER => $headers);

		$ch = curl_init() or die(curl_error());
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);

		curl_close($ch);

		$result = preg_replace('/^[^{]+/', '', $result);#removed header info from response

		$folder= new folder($result);
		return $folder;
	}
	
	public function createDocument($url, $name, $desc) {
		$data= array("title" => $name, "description" => $desc); 
		$data_string = json_encode($data);
		$headers = array('Authorization : OAuth2' ." ". $this -> access_token, 'Accept: application/vnd.huddle.data+json', 'Content-Type: application/vnd.huddle.data+json','Content-Length: '.strlen($data_string));
		$options = array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => 1, CURLOPT_POST => 1, CURLOPT_FOLLOWLOCATION => 1,
		CURLOPT_POSTFIELDS => $data_string,CURLOPT_HEADER => 1, CURLOPT_HTTPHEADER => $headers);

		$ch = curl_init() or die(curl_error());
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);

		curl_close($ch);
		$result = preg_replace('/^[^{]+/', '', $result);
		$document = new document($result);
		return $document;
	}
	
	public function uploadDocument($url){
		// Prepare message for PUT
		
		$fullfilepath = $_FILES["content"]["tmp_name"];
		$upload_url = $url;
		$headers = array('Authorization : OAuth2' ." ". $this -> access_token);
		#$options = array(CURLOPT_URL => $url."!PUT", CURLOPT_RETURNTRANSFER => 1, CURLOPT_POST => 1, CURLOPT_FOLLOWLOCATION => 1,
		#CURLOPT_POSTFIELDS => Array($data_string),CURLOPT_HEADER => 1, CURLOPT_HTTPHEADER => $headers);
		
		$params = array(
		  'doc'=>"@$fullfilepath"
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8888');
		curl_setopt($ch, CURLOPT_URL, $upload_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		curl_close($ch);
		
		echo $response;
		

	}
}
?>