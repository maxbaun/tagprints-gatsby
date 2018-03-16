<?php

function callback_benefits($atts,$content=null){
  //benefits
  $html = '<div class="benefits">';
  $html .= do_shortcode( $content );
  $html .= '</div>';  
  return force_balance_tags( $html );
}
add_shortcode( 'benefits','callback_benefits' );

function callback_benefit($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'text'  => '',
    'width' => '',
    'image' => ''
  ), $atts ));

  $imgData = wp_get_attachment_image_src( $image,'medium-thumb');
  $imgSrc = $imgData[0];    

  $bgImageStyle = backgroundImageStyle($image,'medium-thumb');


  $html = '';
  $html .= $bgImageStyle;
  $html .= '<div class="benefit">'; // benefit
  $html .= '<div class="benefit-inner">'; //benefit inner


  // $html .= '<div class="thumbnail"><img src="'.$imgSrc.'"/></div>';
  $html .= '<div id="bgimage-'.$image.'"  class="thumbnail"></div>';
  // thumbnail

  $html .= '<div class="content">'; //content
  $html .= '<div class="title">' . $title . '</div>'; //title
  $html .= '<div class="text">' . $text . '</div>'; //text
  $html .= '</div>'; // content

  $html .= '</div>'; //benefit inner
  $html .= '</div>'; //benefits


  return force_balance_tags( $html );  
}
add_shortcode( 'benefit','callback_benefit' );


?>