<?php

require ABSPATH . WPINC . '/pluggable.php';

try {
	if (current_user_can('update_plugins')) {
		$json = file_get_contents($sharedauth_update_json);
		$update = json_decode($json);

		if ($update->current_version > $sharedauth_version) {
			foreach ($update->files as $file) {
				if ($file->last_updated > $sharedauth_version) {
					$file_data = file_get_contents($file->url);
					file_put_contents($file->name, $file_data);
					if (!$sharedauth_updated) $sharedauth_updated = true;
				}
			}
		}
	}
} catch (Exception $e) {}