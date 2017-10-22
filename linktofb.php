<?php 
define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook/');
require_once('facebook/autoload.php');

//Returns post id
function postToFB($message, $imgpath) {
	$imgpath = '/'.$imgpath;

	$fb = new Facebook\Facebook([
		'app_id' => '791155091056398',
		'app_secret' => '73a45ec413e81a1588a8999a3cea1888',
		'default_graph_version' => 'v2.10',
		'default_access_token' => 'EAALPjSYqJw4BAGCFQfvhAApzpJrgmmx4n1tW1GriW0GhyNpAoIBdsZAGdFfrO5hvfiHejzD7bYvOU7dt0rvK9Kn5czEe9hriwn4SNOxTKrnPrWwEsPmN9NKwjFWwwAeBEapGSaEEW03dsSUahevAaAn8KSluk9TlOHdB2GNhF1iEGszvB'
		]);
	echo $imgpath;

	//Post property to Facebook
	$linkData = [
	'message' => $message,
	'source' => $fb->fileToUpload($imgpath)
	];


	try {
		$response = $fb->post('/me/feed', $linkData);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: '.$e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: '.$e->getMessage();
		exit;
	}

	$post_id = $response->getDecodedBody()["id"];

	return $post_id;
}

function removeFBPost($fbpost_id) {

	$fb = new Facebook\Facebook([
		'app_id' => '791155091056398',
		'app_secret' => '73a45ec413e81a1588a8999a3cea1888',
		'default_graph_version' => 'v2.10',
		'default_access_token' => 'EAALPjSYqJw4BAGCFQfvhAApzpJrgmmx4n1tW1GriW0GhyNpAoIBdsZAGdFfrO5hvfiHejzD7bYvOU7dt0rvK9Kn5czEe9hriwn4SNOxTKrnPrWwEsPmN9NKwjFWwwAeBEapGSaEEW03dsSUahevAaAn8KSluk9TlOHdB2GNhF1iEGszvB'
		]);

	try {
		$response = $fb->delete('/'.$fbpost_id);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: '.$e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: '.$e->getMessage();
		exit;
	}

	return true;
}
?>