<?php

function callback_featured_section($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'center' => 'true',
    'cta_text' => '',
    'cta_link' => '',
    'size' => '',
    'borders' => '',
    'contain' => '',
    'image' => '',
    'image_size' => '',
    'text_orientation' => 'left',

  ), $atts ));

  $img = do_shortcode('[image id="'.$image.'" size="'.$image_size.'"][/image]');

  $imgData = getImage($image,$image_size);
  $imgHeight = $imgData['height'];


  $html = '';

  $left = '';
  $right = '';

  $title = '<h3 class="title" style="line-height: '.($imgHeight-10).'px;">' . $title . '</h3>';

  if($text_orientation == 'left' ){
    $left = $title;
    $right = $img;
  }
  else if($text_orientation == 'right'){
    $left = $img;
    $right = $title;
  }

  if(isset($center) && $center=='true')
    $class .= ' text-center';
  $html .= '<div class="featured-section '.$size.' '.$borders.'">';
  
  // if(isset($contain) && $contain != 'true')  
  $html .= '<div class="container">'; // container

  if(isset($contain) && $contain == 'true')
    $html .= '<div class="row"><div class="'.get_container_class().'">';

  $html .= '<div class="row">';
  $html .= '<div class="col-md-4">';
  $html .= $left;
  $html .= '</div>';
  $html .= '<div class="col-md-8">';
  $html .= $right;
  $html .= '</div>';
  $html .= '</div>';

  if(isset($contain) && $contain == 'true')
    $html .= '</div></div>'; 

  $html .= '</div>';
  $html .= '</div>';



  return force_balance_tags( $html );
}
add_shortcode( 'featured-section' , 'callback_featured_section' );

?>