<?php

function callback_content_block_icon($atts,$content=null){
  extract(shortcode_atts( array(
    'icon' => '',
    'title' => '',
    'text' => '',
	'lightbox_group' => '',
    'class' => 'text-center',
	'icon_height' => null,
	'icon_width' => null
  ), $atts ));

  $html = '<div class="content-block content-block-icon '.$class. '">';

  if(!empty($icon)){
    // if the image exists
    $html .= '<div class="content-block-image">';
    $html .= do_shortcode('[icon id="'.$icon.'" height="'.$icon_height.'" width="'.$icon_width.'" center="true"]');
    $html .= '</div>';
  }

  if(!empty($text)){
    $html .= '<p class="content-block-text text-center">' . $text . '</p>';
  }

  $html .= '</div>';

  return force_balance_tags( $html );
}

add_shortcode( 'content-block-icon' , 'callback_content_block_icon' );

?>
