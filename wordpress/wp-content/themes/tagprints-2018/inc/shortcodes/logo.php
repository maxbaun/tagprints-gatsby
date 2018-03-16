<?php
/**
 * Shortcode for displaying SVG LogicException
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_logo( $atts ) {
	$atts = shortcode_atts( array(
		'height' => 68.3,
		'width' => 350.6,
		'theme' => 'default',
	), $atts );

	\Timber\Timber::render( 'includes/logo.twig', $atts );
}
add_shortcode( 'logo', 'callback_logo' );
