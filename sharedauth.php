<?php

/*
	Plugin Name: Shared Auth
	description: A custom wordpress plugin to share authentication between multiple Laravel & Wordpress sites.
	Version: 1.071
	Author: Mirza Farhan Hasin
	License: GPL2
*/

define('SA_VERSION', 1.071);
define('SA_PLUGIN_FOLDER', __DIR__);
define('SA_UPDATE_REPO', 'https://raw.githubusercontent.com/mfhprantik/SharedAuth/main');
define('SA_API_ENDPOINT', 'https://stockcarfannation.com');
define('SA_AUTO_UPDATE', true);

function sa_init()
{
	$sa_updated = false;
	require 'start.php';
}

add_action('after_setup_theme', 'sa_init');
