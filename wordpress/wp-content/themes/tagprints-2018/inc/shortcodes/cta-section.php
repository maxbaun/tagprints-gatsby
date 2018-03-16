<?php

function callback_cta_section($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'center' => 'true',
    'cta_text' => '',
    'cta_link' => '',
    'size' => '',
    'borders' => ''
  ), $atts ));

  $html = '';

  if(isset($center) && $center=='true')
    $class .= ' text-center';
  $html .= '<div class="cta-section '.$size.' '.$borders.'">';
  $html .= '<div class="container">'; // container
  $html .= '<h1 class="title small '.$class.'">' . $title . do_shortcode( '[cta class="btn-cta-transparent btn-cta-transparent-inverse" text="'.$cta_text.'" link="'.$cta_link.'"][/cta]' ). '</h1>';
  $html .= '</div>'; // container
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'cta-section' , 'callback_cta_section' );

?>