<?php

function sharedauth_login_user() {
	if (isset($_POST['access_token'])) {
		$authorization = "Authorization: Bearer " . $_POST['access_token'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $sharedauth_api_endpoint . '/api/user');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close ($ch);

		$user = json_decode($response);
		$username = $user->name;
		$password = $user->plain_password;
		$email = $user->email;

		$user_id = wp_create_user($username, $password, $email);
		if (($user_id instanceof WP_Error && (isset($user_id->errors['existing_user_email']) || isset($user_id->errors['existing_user_login']))) || !($user_id instanceof WP_Error)) {
			$user = wp_signon(['user_login' => $username, 'user_password' => $password]);
			wp_set_current_user($user->ID);
		}
	}
}

try {
	if (isset($_GET['action']) && $_GET['action'] == 'login') sharedauth_login_user(); 
} catch (Exception $e) {}