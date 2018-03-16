<?php

function callback_content_block_hashtag($atts,$content=null){
  extract(shortcode_atts( array(
    'image' => '',
    'title' => '',
    'text' => '',
	'lightbox_group' => '',
    'class' => 'text-center',
  ), $atts ));

  $html = '<div class="content-block content-block-hashtag '.$class. '">';

  if(!empty($image)){
    // if the image exists
    $html .= '<div class="content-block-image">';
    $html .= do_shortcode('[image id="'.$image.'" size="content-block-hashtag" lightbox_group="'.$lightbox_group.'"]');
    $html .= '</div>';
  }

  if(!empty($text)){
    $html .= '<h3 class="content-block-title text-center">' . $title . '</h3>';
    $html .= '<p class="content-block-text text-center">' . $text . '</p>';
  }

  $html .= '</div>';

  return force_balance_tags( $html );
}

add_shortcode( 'content-block-hashtag' , 'callback_content_block_hashtag' );

?>
