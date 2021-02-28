<?php

function sa_login_user()
{
	if (isset($_POST['access_token'])) {
		$authorization = "Authorization: Bearer " . $_POST['access_token'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, SA_API_ENDPOINT . '/api/user');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		$user = json_decode($response);

		$user_login = wp_slash($user->email);
		$user_email = wp_slash($user->email);
		$user_pass  = $user->plain_password;
		$user_nicename = $user->name;
		$display_name = $user->name;

		$userdata = compact('user_login', 'user_email', 'user_pass', 'user_nicename', 'display_name');
		return wp_insert_user($userdata);

		$user_id = wp_create_user($username, $password, $email);
		if (($user_id instanceof WP_Error && (isset($user_id->errors['existing_user_email']) || isset($user_id->errors['existing_user_login']))) || !($user_id instanceof WP_Error)) {
			if (!($user_id instanceof WP_Error)) sa_user_created($_POST['access_token'], $_POST['endpoint_id']);
			$user = wp_signon(['user_login' => $username, 'user_password' => $password]);
			wp_set_current_user($user->ID);
		}
	}
}

function sa_user_created($access_token, $endpoint_id)
{
	$authorization = "Authorization: Bearer " . $access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, SA_API_ENDPOINT . '/api/user/notify-created/' . $endpoint_id);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
}

sa_login_user();
