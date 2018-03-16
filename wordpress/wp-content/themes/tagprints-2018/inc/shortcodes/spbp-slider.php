<?php

function callback_spbp_slider($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'text1' => '',
        'text2' => '',
        'background_image' => '',
        'image' => ''
    ), $atts ));

    $html = '';

    $html = '<div class="spbp-slider '.$class.'" style="'.$style.'">'; //spbp-slider

    $html .= '<div class="spbp-slider-inner">'; //spbp-slider-inner

    $html .= '<span class="spbp-art-1"></span>';

    $html .= '<div class="spbp-slider-content">'; //spbp-slider-content
    $html .= '<div class="spbp-slider-content-inner">'; //spbp-slider-content-inner

    $html .= '<div class="spbp-slider-text-1">'; //spbp-slider-text-1
    $html .= '<h1>' . $text1 . '</h1>';
    $html .= '</div>'; //spbp-slider-text-1

    $html .= '<div class="spbp-slider-image">'; //spbp-slider-image
    $html .= do_shortcode('[image id="'.$image.'" size="spbp-photobooth"][/image]');
    $html .= '</div>'; //spbp-slider-image

    $html .= '<div class="spbp-slider-text-2">'; //spbp-slider-text-2
    $html .= '<h1>' . $text2 . '</h1>';
    $html .= '</div>'; //spbp-slider-text-2

    $html .= '</div>'; //spbp-slider-content-inner
    $html .= '</div>'; //spbp-slider-content

    $html .= '<span class="spbp-art-2"></span>';

    $html .= '</div>'; //spbp-slider-inner

    $html .= '</div>'; //spbp-slider

    return force_balance_tags( $html );
}
add_shortcode( 'spbp-slider' , 'callback_spbp_slider' );
