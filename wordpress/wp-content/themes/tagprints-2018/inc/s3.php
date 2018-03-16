<?php

$tpS3IsDeleting = false;
add_filter('as3cf_attachment_file_paths', 'tpS3addRetinaToS3');
add_filter('delete_attachment', 'tpS3deleteAttachment');

function tpS3deleteAttachment() {
	$tpS3IsDeleting = true;
}

function tpS3addRetinaToS3($paths) {
	if (!class_exists('WP_Offload_S3_Autoloader')) {
		return;
	}
	foreach ($paths as $path) {
		$retina = tpS3getRetinaFile($path);
		if (!empty($retina) || $tpS3IsDeleting) {
			$paths[] = $retina;
		}
	}

	return $paths;
}

function tpS3getRetinaFile($path) {
	$info = pathinfo($path);
	$retina = $info['dirname'] . '/' . $info['filename'] . '@2x.' . $info['extension'];

	if ($tpS3IsDeleting || file_exists($retina)) {
		return $retina;
	}

	return;
}
