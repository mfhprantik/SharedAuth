<?php

set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
	throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
}, E_WARNING);

try {
	if ($_GET['action'] == 'update') require 'updater.php';
	elseif ($_GET['action'] == 'login') require 'run.php';
} catch (Exception $e) {
}

restore_error_handler();