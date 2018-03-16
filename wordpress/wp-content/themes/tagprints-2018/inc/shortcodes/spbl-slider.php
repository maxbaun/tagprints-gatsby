<?php

function callback_spbl_slider($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'text1' => '',
        'text2' => '',
        'background_image' => '',
        'image' => ''
    ), $atts ));

    $html = '';

    $html = '<div class="spbl-slider '.$class.'" style="'.$style.'">'; //spbl-slider

    $html .= '<div class="container spbl-slider-inner">'; //spbl-slider-inner

	$html .= '<div class="">'; //container

    $html .= '<div class="spbl-slider-content">'; //spbl-slider-content
    $html .= '<div class="spbl-slider-content-inner">'; //spbl-slider-content-inner

	$html .= '<div class="spbl-slider-content-text">'; // spbl-slider-content-text

	$html .= '<div class="spbl-slider-text-2">'; //spbl-slider-text-2
    $html .= '<h1>' . $text2 . '</h1>';
    $html .= '</div>'; //spbl-slider-text-2

    $html .= '<div class="spbl-slider-text-1">'; //spbl-slider-text-1
    $html .= '<h1>' . $text1 . '</h1>';
    $html .= '</div>'; //spbl-slider-text-1

	$html .= '</div>'; // spbl-slider-content-text

    $html .= '<div class="spbl-slider-image">'; //spbl-slider-image
    $html .= do_shortcode('[image id="'.$image.'" size="carousel"][/image]');
    $html .= '</div>'; //spbl-slider-image

    $html .= '</div>'; //spbl-slider-content-inner
    $html .= '</div>'; //spbl-slider-content

	$html .= '</div>'; //container

    $html .= '</div>'; //spbl-slider-inner

    $html .= '</div>'; //spbl-slider

    return force_balance_tags( $html );
}
add_shortcode( 'spbl-slider' , 'callback_spbl_slider' );
