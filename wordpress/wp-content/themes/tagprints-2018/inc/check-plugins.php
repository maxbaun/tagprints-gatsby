<?php

global $TAGPRINTS_REQUIRED_PLUGINS;
global $TAGPRINTS_INACTIVE_PLUGINS;

$TAGPRINTS_REQUIRED_PLUGINS = array(
	array(
		'name' => 'Advanced Custom Fields Pro',
		'plugin' => 'advanced-custom-fields-pro/acf.php'
	),
	array(
		'name' => 'Amazon S3 & Cloudfront Pro',
		'plugin' => 'amazon-s3-and-cloudfront-pro/amazon-s3-and-cloudfront-pro.php'
	)
);

$TAGPRINTS_INACTIVE_PLUGINS = array();

add_action('admin_init', function () {
	global $TAGPRINTS_REQUIRED_PLUGINS;
	global $TAGPRINTS_INACTIVE_PLUGINS;

	foreach ($TAGPRINTS_REQUIRED_PLUGINS as $plugin) {
		if (!is_plugin_active($plugin['plugin'])) {
			$TAGPRINTS_INACTIVE_PLUGINS[] = $plugin['name'];
			add_action('admin_notices', 'tagprintsRequiredPluginsNotice');
		}
	}
});

function tagprintsRequiredPluginsNotice() {
	global $TAGPRINTS_INACTIVE_PLUGINS;

	?>
		<div class="notice error">
			<p>Please make sure all required plugins are installed and enabled</p>
			<em><?php echo implode(', ', $TAGPRINTS_INACTIVE_PLUGINS); ?></em>
		</div>
	<?php
}
