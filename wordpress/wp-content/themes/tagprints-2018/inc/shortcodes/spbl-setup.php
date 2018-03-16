<?php

function callback_spbl_setup($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'gif' => ''
    ), $atts ));

    $html = '';

    $html = '<div class="spbl-setup '.$class.'" style="'.$style.'">'; //spbl-slider

	$html .= '<div class="container">'; //container

	$html .= '<div class="spbl-setup-inner">'; // spbl-setup-inner

	$html .= '<div class="row">'; // row

	$html .= '<div class="col-sm-3 col-sm-offset-2">';
	$html .= '<div class="spbl-setup-gif">';
	$html .= do_shortcode('[image id="'.$gif.'" gif="true"][/image]');
	$html .= '</div>';
	$html .= '</div>'; //col-sm-5

	$html .= '<div class="col-sm-6 col-sm-offset-1">';

	$html .= '<div class="spbl-setup-content">'; //spbl-setup-content
	$html .= do_shortcode($content);
	$html .= '</div>'; //spbl-setup-content

	$html .= '</div>'; // col-sm-7


	$html .= '</div>'; // row

	$html .= '</div>'; //spbl-setup-inner

	$html .= '</div>'; //container

    $html .= '</div>'; //spbl-setup

    return force_balance_tags( $html );
}
add_shortcode( 'spbl-setup' , 'callback_spbl_setup' );

function callback_spbl_setup_block($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'title' => '',
        'text' => '',
        'icon' => ''
    ), $atts ));

    $html = '';

    $html = '<div class="spbl-setup-block '.$class.'" style="'.$style.'">'; //spbl-slider

	if (!empty($icon)) {
		$html .= do_shortcode('[icon id="'.$icon.'"/]');
	}

	$html .= '<h3>' . $title . '</h3>';
	$html .= '<p>' . $text . '</h3>';

	$html .= '</div>';

    return force_balance_tags( $html );
}
add_shortcode( 'spbl-setup-block' , 'callback_spbl_setup_block' );
