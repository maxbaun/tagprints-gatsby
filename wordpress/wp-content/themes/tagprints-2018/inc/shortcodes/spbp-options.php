<?php

function callback_spbp_options($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'title1' => '',
        'title2' => ''
    ), $atts ));

    $dIcons = array('photo-gallery', 'surveys-data', 'lead-gen', 'disclaimers', 'email-options');
    $r1Icons = array('daily', 'monthly', 'long');
    $r2Icons = array('onsite', 'shipped');
    $miniBooth = get_template_directory_uri() . '/dist/images/icon-mini-booth.svg';

    $html = '';

    $html = '<div class="spbp-options '.$class.'" style="'.$style.'">'; //spbp-options

    $html .= '<div class="container">'; //container

    $html .= '<div class="spbp-deliverables">'; //spbp-deliverables
    $html .= '<div class="spbp-options-inner">'; //spbp-options-inner
    $html .= '<h1 class="spbp-title">' . $title1 . '</h1>';
    $html .= '<div class="spbp-deliverables-icon-wrap">'; //spbp-deliverables-icons

    foreach ($dIcons as $icon) {
        $img = get_template_directory_uri() . '/dist/images/icon-' . $icon . '.svg';
        $html .= '<span class="spbp-deliverables-icon">';
        $html .= '<img src="'.$img.'"/>';
        $html .= '</span>';
    }

    $html .= '</div>';
    $html .= '</div>'; //spbp-options-inner
    $html .= '</div>'; //spbp-deliverables

    $html .= '<div class="spbp-rental-options">'; //spbp-rental-options
    $html .= '<div class="spbp-options-inner">'; //spbp-options-inner

    $html .= '<h1 class="spbp-title">' . $title2 . '</h1>';

    $html .= '<div class="spbp-rental-options-group">'; //spbp-rental-options-group

    $html .= '<div class="spbp-rental-options-title">'; //spbp-rental-options-title
    $html .= '<h3>Rental Options:</h3>';
    $html .= '</div>'; //spbp-rental-options-title

    $html .= '<div class="spbp-rental-options-icon-group">'; //spbp-rental-options-icon-group
    foreach ($r1Icons as $icon) {
        $img = get_template_directory_uri() . '/dist/images/icon-' . $icon . '.svg';
        $html .= '<span class="spbp-rental-options-icon" data-count="3">';
        $html .= '<img src="'.$img.'"/>';
        $html .= '</span>';
    }
    $html .= '</div>'; //spbp-rental-options-icon-group
    $html .= '</div>'; //spbp-rental-options-group

    $html .= '<div class="spbp-rental-options-group minibooth">'; //spbp-rental-options-group

    $html .= '<div class="spbp-rental-options-title">'; //spbp-rental-options-title
    $html .= '<img src="'.$miniBooth.'"/>';
    $html .= '</div>'; //spbp-rental-options-title

    $html .= '<div class="spbp-rental-options-icon-group">'; //spbp-rental-options-icon-group
    foreach ($r2Icons as $icon) {
        $img = get_template_directory_uri() . '/dist/images/icon-' . $icon . '.svg';
        $html .= '<span class="spbp-rental-options-icon" data-count="2">';
        $html .= '<img src="'.$img.'"/>';
        $html .= '</span>';
    }
    $html .= '</div>'; //spbp-rental-options-icon-group
    $html .= '</div>'; //spbp-rental-options-group

    $html .= '</div>'; //spbp-options-inner
    $html .= '</div>'; //spbp-rental-options

    $html .= '</div>'; //container
    $html .= '</div>'; //spbp-options

    return force_balance_tags( $html );
}
add_shortcode( 'spbp-options' , 'callback_spbp_options' );
