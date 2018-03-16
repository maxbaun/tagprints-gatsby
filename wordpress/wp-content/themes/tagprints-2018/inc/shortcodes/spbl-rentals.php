<?php
function callback_spbl_rentals($atts, $content=null) {
	extract(shortcode_atts( array(
		'class' => '',
		'style' => '',
		'title' => '',
		'images' => '',
		'links' => '',
		'text' => ''
    ), $atts ));

	$html = '';

	$images = explode(',', $images);
	$text = explode(',', $text);
	$links = explode(',', $links);

	$html .= '<div class="spbl-rentals '.$class.'" style="'.$style.'">'; //spbl-slider

	$html .= '<div class="spbl-rentals-bg spbl-rentals-bg1"></div>';
	$html .= '<div class="spbl-rentals-bg spbl-rentals-bg2"></div>';

	$html .= '<div class="spbl-rentals-title-wrap">'; //spbl-rentals-title-wrap
	$html .= '<h3>' . $title . '</h3>';
	$html .= '</div>'; //spbl-rentals-title-wrap

	$html .= '<div class="spbl-rentals-content-wrap">'; //spbl-rentals-content-wrap

	$html .= '<div class="spbl-rental-options">'; //spbl-rental-options
	$count = 0;
	foreach ($images as $image) {
		$html .= '<div class="spbl-rental-option">';
		if (!empty($links[$count])) {
			$html .= '<a href="' . $links[$count] . '">';
		}
		$html .= do_shortcode('[image id="'.$image.'" size="mini" center="true"][/image]');
		$html .= '<span class="spbl-rental-option-text">' . $text[$count] . '</span>';
		if (!empty($links[$count])) {
			$html .= '</a>';
		}
		$html .= '</div>';

		$count++;
	}
	$html .= '</div>'; //spbl-rental-options

	$html .= '</div>'; //spbl-rentals-content-wrap

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-rentals', 'callback_spbl_rentals');
