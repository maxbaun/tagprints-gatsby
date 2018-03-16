<?php
/**
 * Cutlass includes
 *
 * The $cutlass_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */

require_once(dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php');

new Timber\Timber();
\Timber\Timber::$dirname = array( 'templates' );

// define('DISALLOW_FILE_EDIT', true); // Don't allow file edtiting
// define('DISALLOW_FILE_MODS', true); // Don't allow plugin uploads

$cutlass_includes = array(
  'inc/assets.php',                  // Custom widget areas
  'inc/replace-images.php',			// replace images for dev
  'inc/utils.php',                  // Utility functions
  'inc/deregister-scripts.php',                   // deregister scripts
  'inc/init.php',                   // Initial theme setup and constants
  'inc/theme-settings.php',                  // Custom theme settings
  'inc/our-work-component.php',                   // Initial react theme setup
  'inc/react-app.php',                   // Initial react theme setup
  'inc/config.php',                 // Configuration
  'inc/activation.php',             // Theme activation
  'inc/titles.php',                 // Page titles
  'inc/wp_bootstrap_navwalker.php', // Bootstrap Nav Walker (From https://github.com/twittem/wp-bootstrap-navwalker)
  'inc/gallery.php',                // Custom [gallery] modifications
  'inc/comments.php',               // Custom comments modifications
  'inc/extras.php',                 // Custom functions
  'inc/image-sizes.php',            // custom image sizes
  'inc/shortcodes/index.php',               // Custom shortcodes
  'inc/custom-post-types/case-study.php',   // Custom case study post type
  'inc/custom-post-types/icons.php',   // Custom icon post type
  'inc/custom-post-types/lookbook.php',   // Custom icon post type
  'inc/widgets.php',                  // Custom widget areas
  'inc/widgets/index.php',                  // Custom widgets
  'inc/s3.php',                  // Custom widgets
  'inc/check-plugins.php',                  // Custom widgets
);

foreach ($cutlass_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'cutlass'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);
