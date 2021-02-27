<?php

require ABSPATH . WPINC . '/pluggable.php';

if (current_user_can('update_plugins')) {
	$json = file_get_contents(SA_UPDATE_REPO . '/update.json');
	$update = json_decode($json);

	if ($update->current_version > SA_VERSION) {
		foreach ($update->files as $file) {
			try {
				if ($file->last_updated > SA_VERSION) {
					if ($file->type == 'delete') unlink(SA_PLUGIN_FOLDER . $file->name);
					else {
						$file_data = file_get_contents(SA_UPDATE_REPO . $file->name);
						file_put_contents(SA_PLUGIN_FOLDER . $file->name, $file_data);
					}
				}
			} catch (Exception $e) {
				
			}
		}
	}
}