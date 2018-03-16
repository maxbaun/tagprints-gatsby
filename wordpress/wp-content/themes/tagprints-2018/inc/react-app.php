<?php

global $SMUGMUG_BASE;
$SMUGMUG_BASE = 'photos';

add_action('init', function () {
	global $SMUGMUG_BASE;

	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$url_path = explode('/', $url_path);
	if ($url_path[0] === $SMUGMUG_BASE) {
		// load the file if exists
		add_action('wp_enqueue_scripts', 'reactAppData', 101);
		$load = locate_template('template-smugmug.php', true);
		if ($load) {
			exit(); // just exit if template was found and loaded
		}
	}
});

function reactAppData() {
	global $SMUGMUG_BASE;

	$tagprints_smugmug_data = array(
		'BasePath' => '/' . $SMUGMUG_BASE,
		'AjaxUrl' => admin_url('admin-ajax.php')
	);
	wp_localize_script('tagprints/js', 'TagprintsSmugmugData', $tagprints_smugmug_data);
	wp_enqueue_script('tagprints/smugmug', asset_path('scripts/smugmug.js'), ['tagprints/js'], null, true);
}

function smugmug_request() {
	$url = $_GET['url'];

	smugmugGet($url);
}

function smugmugGet($url) {
	$response = wp_remote_get($url, array(
		'headers' => array(
			'Accept' => 'application/json'
		),
		'cookies' => array('SMSESS' => $_COOKIE['SMSESS'])
	));
	wp_send_json_success(json_decode($response['body'])->Response);
}

add_action('wp_ajax_smugmug', 'smugmug_request');
add_action('wp_ajax_nopriv_smugmug', 'smugmug_request');

function smugmug_unlock() {
	$password = $_GET['password'];
	$url = $_GET['url'];
	$successUrl = $_GET['successUrl'];

	$response = wp_remote_post($url, array(
		'method' => 'POST',
		'headers' => array(
			'Accept' => 'application/json'
		),
		'body' => array('Password' => $password)
	));

	$json = json_decode($response['body']);
	if ($json->Code == 200) {
		$cookies = $response['cookies'];
		$cookie_arr = array();
		foreach($cookies as $cookie) {
			setcookie($cookie->name, $cookie->value);
			$cookie_arr[] = array('name' => $cookie->name, 'value' => $cookie->value);
		}
		wp_send_json_success(array('cookies' => $cookie_arr));
		// smugmugGet($successUrl);
	} else {
		wp_send_json_error($json);
	}
}


add_action('wp_ajax_smugmug_unlock', 'smugmug_unlock');
add_action('wp_ajax_nopriv_smugmug_unlock', 'smugmug_unlock');

?>
