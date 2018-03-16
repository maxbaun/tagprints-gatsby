<?php
/**
 * Shortcode for displaying the array13 section
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_array13_section( $atts, string $content = null ) {
	$atts = shortcode_atts( array(
		'text1' => '',
		'text2' => '',
		'text3' => '',
		'contain' => 'true',
		'background_image' => '',
		'background_color' => '#000000',
		'content' => do_shortcode( $content ),
	), $atts );

	return \Timber\Timber::compile( 'includes/array13-section.twig', $atts );
}
add_shortcode( 'array13-section', 'callback_array13_section' );
