<?php

function callback_quote_block($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'image' => '',
    'text' => '',
    'company_logo' => '',
    'position' => '',
    'name' => '',
    'image_size' => 'small',
    'quote_info' => 'true',
    'title' => ''
  ), $atts ));  

  $html = '<div class="quote-block '.$class.'" style="'.$style.'">'; //quote block

  $html .= '<div class="row"><div class="col-md-10 col-md-offset-1">';
  $html .= '<div class="quote-content">'; //quote-content

  $html .= '<div class="thumbnail">'; //thumbnail
  $html .= do_shortcode( '[image id="'.$image.'" size="'.$image_size.'"][/image]' );
  $html .= '</div>'; //thumbnail

  $html .= '<div class="text">'; //text

  if(isset($title) && $title != ''){
    $html .= '<h1 class="title medium">' . $title . '</h1>';//title
  }

  $html .= do_shortcode('[text-block]'.$text.'[/text-block]');
  $html .= '</div>';
  $html .= '</div>'; // quote-content
 

  if(isset($quote_info) && $quote_info == 'true'){
  //quote-info
  $html .= '<div class="quote-info">'; 
  $html .= '<div class="company">'; //company logo
  $html .= do_shortcode( '[image id="'.$company_logo.'" size="mini"][/image]' );
  $html .= '</div>'; //company logo

  
  $html .= '<div class="person">'; // person
  $html .= '<div class="name">' . $name . '</div>'; //name
  $html .= '<div class="position">' . $position . '</div>'; //position
  $html .= '</div>'; //person
  $html .= '</div>';  
  //quote-info  
  }

  $html .= '</div></div>';

  $html .= do_shortcode( $content );
  $html .= '</div>'; //quote block

  return force_balance_tags($html);
}

add_shortcode('quote-block','callback_quote_block' );

?>