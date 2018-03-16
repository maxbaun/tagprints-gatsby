<?php

function callback_spbl_section($atts, $content=null) {
	extract(shortcode_atts( array(
		'class' => '',
		'style' => '',
		'contain' => 'false',
		'id' => '',
        'background_color' => '',
		'background_image' => ''
    ), $atts ));

	$html = '';

	$bgImgStyle = backgroundImageStyle($background_image, 'hero', true);

	if (!empty($background_color)) {
		$style .= 'background-color:' . $background_color . ';';
	}

	$html .= $bgImgStyle;

	$html .= '<div id="'.$id.'" class="spbl-section '.$class.'" style="'.$style.'">'; //spbl-slider

	if (!empty($background_image)) {
		$html .= '<div id="bgimage-'.$background_image.'" class="spbl-section-bg"></div>';
	}

	if ($contain == 'true') {
		$html .= '<div class="container">';
	}

	$html .= do_shortcode($content);

	if ($contain == 'true') {
		$html .= '</div>';
	}

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-section', 'callback_spbl_section');

function callback_spbl_title($atts, $content=null) {
	extract(shortcode_atts( array(
		'class' => '',
		'style' => '',
        'text' => '',
		'color' => ''
    ), $atts ));

	$html = '';

	$h1Style = '';

	if (!empty($color)) {
		$h1Style .= 'color: ' . $color . ';';
	}

	$html = '<div class="spbl-title '.$class.'" style="'.$style.'">'; //spbl-slider

	$html .= '<h1 style="'.$h1Style.'">' . $text . '</h1>';

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-title', 'callback_spbl_title');

function callback_spbl_text_block($atts, $content=null) {
	extract(shortcode_atts( array(
		'class' => '',
		'style' => '',
		'center' => 'false'
    ), $atts ));

	$html = '';

	$html = '<div class="spbl-text '.$class.'" style="'.$style.'">'; //spbl-slider

	if ($center == 'true') {
		$html .= '<div class="text-center">';
	}

	$html .= do_shortcode($content);

	if ($center == 'true') {
		$html .= '</div>';
	}

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-text-block', 'callback_spbl_text_block');

function callback_spbl_button($atts, $content=null) {
	extract(shortcode_atts( array(
		'class' => '',
		'style' => '',
		'link' => '',
        'text' => '',
		'size' => 'lg',
		'center' => 'false'
    ), $atts ));

	$html = '';

	if ($center == 'true') {
		$class .= ' text-center ';
	}

	$html = '<div class="spbl-button '.$class.'" style="'.$style.'">'; //spbl-slider

	$html .= '<a href="'.$link.'" class="btn btn-'.$size.' btn-spbl">' . $text . '</a>';

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-button', 'callback_spbl_button');
