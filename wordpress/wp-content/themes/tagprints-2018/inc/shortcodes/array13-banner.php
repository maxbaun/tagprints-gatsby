<?php
/**
 * Shortcode for displaying the array13 banner
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_array13_banner( $atts ) {
	$atts = shortcode_atts( array(
		'image' => '',
		'text1' => '',
		'text2' => '',
		'text3' => '',
	), $atts );

	return \Timber\Timber::compile( 'includes/array13-banner.twig', $atts );
}
add_shortcode( 'array13-banner', 'callback_array13_banner' );
