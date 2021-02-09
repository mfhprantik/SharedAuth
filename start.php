<?php

set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
	throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
}, E_WARNING);

try {
	require 'update.php';
	if ($updated) require 'config.php';
	else require 'run.php';
} catch (Exception $e) {}

restore_error_handler();

?>