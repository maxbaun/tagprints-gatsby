<?php

function callback_spbp_recent($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'title' => '',
        'image1' => '',
        'image2' => ''
    ), $atts ));

    $html = '';

    $html = '<div class="spbp-recent '.$class.'" style="'.$style.'">'; //spbp-recent

    $html .= '<div class="container">'; //container
    $html .= '<div class="spbp-recent-inner">'; //spbp-recent-inner

    $html .= '<div class="spbp-recent-left">'; //spbp-recent-left
    $html .= '<span class="spbp-waves"></span>';
    $html .= '<h1 class="spbp-title">' . $title . '</h1>'; //spbp-recent-title
    $html .= '<div class="spbp-recent-image-wrap">'; //spbp-recent-image-wrap
    $html .= '<div class="spbp-recent-image">'; //spbp-recent-image
    $html .= do_shortcode('[image id="'.$image1.'" size="spbp-experience"][/image]');
    $html .= '</div>'; //spbp-recent-image
    $html .= '</div>'; //spbp-recent-image-wrap
    $html .= '<span class="spbp-recent-arrow"></span>'; //spbp-recent-arrow
    $html .= '</div>'; //spbp-recent-left


    $html .= '<div class="spbp-recent-right">'; //spbp-recent-right
    $html .= '<div class="spbp-recent-image-wrap">'; //spbp-recent-image-wrap
    $html .= '<div class="spbp-recent-image">'; //spbp-recent-image
    $html .= do_shortcode('[image id="'.$image2.'" size="spbp-experience"][/image]');
    $html .= '</div>'; //spbp-recent-image
    $html .= '</div>'; //spbp-recent-image-wrap
    $html .= '</div>'; //spbp-recent-right

    $html .= '</div>'; //spbp-recent-inner
    $html .= '</div>'; //container
    $html .= '</div>'; //spbp-recent

    return force_balance_tags( $html );
}
add_shortcode( 'spbp-recent' , 'callback_spbp_recent' );
