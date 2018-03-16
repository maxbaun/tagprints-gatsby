<?php
/**
 * Shortcode for displaying the array13 icons
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_array13_icons( $atts, string $content = null ) {
	$atts = shortcode_atts( array(
		'icons' => '',
		'text' => '',
		'color' => '#FFFFFF',
	), $atts );

	$icons = explode( ',', $atts['icons'] );
	$text = explode( ',', $atts['text'] );

	$data = array(
		'icons' => array(),
	);

	$count = 0;

	foreach ( $icons as $icon ) {

		$data['icons'][] = array(
			'icon' => 'icons/array13-' . $icon . '.twig',
		);

		$count++;
	}

	return \Timber\Timber::compile( 'includes/array13-icons.twig', $data );
}
add_shortcode( 'array13-icons', 'callback_array13_icons' );
