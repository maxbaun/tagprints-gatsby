<?php

function callback_content_block($atts,$content=null){
  extract(shortcode_atts( array(
    'image' => '',
    'text' => '',
    'orientation' => 'horizontal',
    'size' => '',
    'icon' => null,
    'icon_width' => null,
    'icon_height' => null,
    'class' => 'text-center',
  ), $atts ));

  $class .= (isset($size) && $size != '') ? ' content-block-' . $size : '';
  $orientationClass = (isset($orientation) && $orientation !='') ? 'content-block-'.$orientation : 'content-block-horizontal';
  $html = '<div class="content-block '.$class. ' ' . $orientationClass.'">';

  if(isset($image) && $image != ''){
    // if the image exists
    $imgSize = (isset($orientation) && $orientation !='') ? 'content-block-'.$orientation : 'content-block-horizontal';
    $html .= '<div class="content-block-image">';
    $html .= imageShortcode($image,$imgSize);
    $html .= '</div>';
  } else if(isset($icon) && $icon != ''){
    // if the image exists
    $html .= '<div class="content-block-image">';
    $html .= iconShortcode($icon,$icon_width,$icon_height,true);
    $html .= '</div>';
  }

  if(isset($text) && $text != ''){
    $html .= '<p class="content-block-text text-center">' . $text . '</p>';
  }

  $html .= '</div>';

  return force_balance_tags( $html );
}

add_shortcode( 'content-block' , 'callback_content_block' );

?>
