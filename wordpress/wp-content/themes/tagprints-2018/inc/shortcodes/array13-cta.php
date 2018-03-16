<?php
/**
 * Shortcode for displaying the array13 background
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_array13_cta( $atts, string $content = null ) {
	$atts = shortcode_atts( array(
		'contain' => '',
        'text' => 'Free Quote',
        'form' => '',
		'style' => '',
		'content' => do_shortcode( $content ),
	), $atts );

	return \Timber\Timber::compile( 'includes/array13-background.twig', $atts );
}
add_shortcode( 'array13-cta', 'callback_array13_cta' );
