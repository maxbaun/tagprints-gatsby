<?php

add_action('init', function () {
	$base = ourWorkBase();

	if (!isset($base)) {
		return;
	}

	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$url_path = explode('/', $url_path);
	if ($url_path[0] === $base) {
		// load the file if exists
		add_action('wp_enqueue_scripts', 'ourWorkScripts', 101);
		$load = locate_template('template-our-work.php', true);
		if ($load) {
			exit(); // just exit if template was found and loaded
		}
	}
});

function ourWorkScripts() {
	$base = ourWorkBase();

	if (!isset($base)) {
		return;
	}

	$tagprintsOurWorkData = array(
		'BasePath' => '/' . ourWorkBase(),
		'AjaxUrl' => admin_url('admin-ajax.php'),
		'ApiUrl' => get_home_url() . '/wp-json',
		'CTAUrl' => get_permalink(getSetting('cta_page')),
		'PerPage' => 18
	);

	wp_localize_script('tagprints/js', 'TagprintsOurWorkData', $tagprintsOurWorkData);
	wp_enqueue_script('tagprints/vendor', asset_path('scripts/vendor.js'), ['tagprints/js'], null, true);
	wp_enqueue_script(
		'tagprints/our-work',
		asset_path('scripts/ourWork.js'),
		['tagprints/js', 'tagprints/vendor'],
		null,
		true
	);
}

function ourWorkBase() {
	$ourWorkBase = get_permalink(getSetting('our_work_page'));
	$siteUrl = get_home_url();

	$ourWorkBase = str_replace($siteUrl, '', $ourWorkBase);
	$parts = explode('/', $ourWorkBase);

	if (!isset($parts[1])) {
		return;
	}

	return $parts[1];
}
