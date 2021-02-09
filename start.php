<?php

set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
	throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
}, E_WARNING);

if (SA_AUTO_UPDATE) require 'update.php';
if (!$sa_updated) require 'run.php';

restore_error_handler();