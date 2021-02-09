<?php

/*
	Plugin Name: Shared Auth
	description: A custom wordpress plugin to share authentication between multiple Laravel & Wordpress sites.
	Version: 1.05
	Author: Mirza Farhan Hasin
	License: GPL2
*/

function sharedauth_init() {
	$sharedauth_version = 1.05;
	$sharedauth_update_json = 'https://raw.githubusercontent.com/mfhprantik/SharedAuth/main/update.json';
	$sharedauth_api_endpoint = 'https://stockcarfannation.com';
	$sharedauth_auto_update = true;
	$sharedauth_updated = false;

	require 'start.php';
}

add_action( 'after_setup_theme', 'sharedauth_init' );