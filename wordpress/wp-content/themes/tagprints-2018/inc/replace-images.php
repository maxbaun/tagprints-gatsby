<?php

if (defined('WP_ENV') && WP_ENV != 'production') {
	add_action('init', 'replace_image_urls');
}

function replace_image_urls()
{
	if (defined('WP_HOME') && defined('LIVE_SITEURL')) {
		if (WP_HOME != LIVE_SITEURL) {
			add_filter('wp_get_attachment_url', 'replace_attachment_url', 10, 2);
		}
	}
}

function replace_attachment_url($url, $post_id)
{
	if ($file = get_post_meta($post_id, '_wp_attached_file', true)) {
		if (($uploads = wp_upload_dir()) && false === $uploads['error']) {
			if (file_exists($uploads['basedir'] . '/' . $file)) {
				return $url;
			}
		}
	}
	return str_replace(WP_HOME, LIVE_SITEURL, $url);
}
