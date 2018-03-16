<?php
/**
 * Shortcode for displaying the array13 gallery
 *
 * @package - TagPrints Theme 2015
 * @param array $atts An array of attributes.
 */
function callback_array13_gallery( $atts ) {
	$atts = shortcode_atts( array(
		'images' => '',
		'text' => '',
		'more_text' => '',
		'more_target' => '',
		'more_link' => '',
		'id' => '',
	), $atts );

	$images = explode( ',', $atts['images'] );
	$text = explode( ',', $atts['text'] );

	$image_rows = array_chunk( $images, 3 );
	$text_rows = array_chunk( $text, 3 );

	$outter = 0;

	$data = array(
		'id' => $atts['id'],
		'rows' => array(),
	);

	if ( ! empty( $atts['more_link'] ) ) {
		$data['more'] = array(
			'text' => $atts['more_text'],
			'link' => $atts['more_link'],
			'target' => $atts['more_target'],
		);
	}

	foreach ( $image_rows as $row ) {
		$inner = 0;
		$data['rows'][ $outter ] = array();

		foreach ( $row as $column ) {
			$data['rows'][ $outter ][] = array(
				'image' => $column,
				'text' => $text_rows[ $outter ][ $inner ],
			);
		}

		$outter++;
	}

	return \Timber\Timber::compile( 'includes/array13-gallery.twig', $data );
}
add_shortcode( 'array13-gallery', 'callback_array13_gallery' );
