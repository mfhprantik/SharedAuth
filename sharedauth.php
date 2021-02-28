<?php

/*
	Plugin Name: Shared Auth
	description: A custom wordpress plugin to share authentication between multiple Laravel & Wordpress sites.
	Version: 1.073
	Author: Mirza Farhan Hasin
	License: GPL2
*/

define('SA_VERSION', 1.073);
define('SA_PLUGIN_FOLDER', __DIR__);
define('SA_UPDATE_REPO', 'https://raw.githubusercontent.com/mfhprantik/SharedAuth/main');
define('SA_API_ENDPOINT', 'https://stockcarfannation.com');

function sa_init()
{
	require 'start.php';
}

if (isset($_GET['action'])) add_action('after_setup_theme', 'sa_init');
