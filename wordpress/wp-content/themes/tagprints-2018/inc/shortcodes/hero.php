<?php

function callback_hero($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'center' => 'false',
        'index' => '',
        'contain' => 'false',
        'image' => '',
        'overlay' => 'true',
        'cover' => 'false'
    ), $atts ));

    if($cover == 'true') {
        $class .= ' hero-cover';
        $bgImgStyle = backgroundImageStyle($image,'hero', true);
    } else {
        $bgImgStyle = retinaImageStyle($image,'hero');
    }

    $html = '';
    $html .= $bgImgStyle;

    $html .= '<div id="bgimage-'.$image.'" class="hero '.$class.'">'; // hero

    if(!empty($overlay) && $overlay == 'true'){
        $html .= '<div class="overlay">'; // overlay
    }

    if(isset($contain) && $contain == 'true'){
        $html .= '<div class="row"><div class="'.get_container_class().'">'; //contain
    }

    if(!empty($center) && $center == 'true') {
        $html .= '<div class="vertical-center"><div class="vertical-center-inner">'; // vertical center
    }

    $html .= '<div class="hero-content">';
    $html .= do_shortcode($content);
    $html .= '</div>';

    if(!empty($center) && $center == 'true') {
        $html .= '</div></div>'; // vertical center
    }

    if(isset($contain) && $contain == 'true') {
        $html .= '</div></div>'; // container
    }

    if(!empty($overlay) && $overlay == 'true'){
        $html .= '</div>'; // overlay
    }

    $html .= '</div>'; // hero

    return force_balance_tags( $html );
}
add_shortcode( 'hero' , 'callback_hero' );

?>
