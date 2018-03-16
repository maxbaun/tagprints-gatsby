<?php

function callback_spbl_sharing($atts, $content=null) {
	extract(shortcode_atts( array(
		'icons' => '',
        'text' => ''
    ), $atts ));

	$html = '';

	$html = '<div class="spbl-sharing">'; //spbl-slider

	$html .= '<span class="spbl-sharing-social-wrap">'; // spbl-sharing-social-wrap
	$html .= '<div class="spbl-sharing-icon-wrap">'; //spbl-sharing-icon-wrap
	$icons = explode(',', $icons);
	foreach ($icons as $icon) {
		$html .= '<span class="spbl-sharing-icon fa fa-'.$icon.'"></span>';
	}
	$html .= '</div>'; //spbl-sharing-icon-wrap
	$html .= '</span>'; // spbl-sharing-social-wrap

	$html .= '<span class="spbl-sharing-text-wrap">'; // spbl-sharing-text-wrap

	$html .= $text;

	$html .= '</span>'; // // spbl-sharing-text-wrap

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-sharing', 'callback_spbl_sharing');
