<?php

$json = file_get_contents($update_json);
$update = json_decode($json);

if ($update->current_version > $version) {
	foreach ($update->files as $file) {
		if ($file->last_updated > $version) {
			$file_data = file_get_contents($file->url);
			file_put_contents($file->name, $file_data);
			if (!$updated) $updated = true;
		}
	}
}