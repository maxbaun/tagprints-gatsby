<?php
/**
 * Shortcode for displaying the array13 background
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_array13_background( $atts, string $content = null ) {
	$atts = shortcode_atts( array(
		'contain' => '',
		'background_image' => '',
		'background_color' => '#000000',
		'style' => '',
		'content' => do_shortcode( $content ),
	), $atts );

	return \Timber\Timber::compile( 'includes/array13-background.twig', $atts );
}
add_shortcode( 'array13-background', 'callback_array13_background' );
