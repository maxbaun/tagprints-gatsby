<?php

function callback_gif_frames($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'count' => ''
  ), $atts ));

  global $GIF_FRAME_TOTAL;
  global $GIF_FRAME_COUNT;

  $GIF_FRAME_COUNT = 0;
  $GIF_FRAME_TOTAL = (empty($count)) ? 1 : intval($count);

  $html = '';

  $html .= '<div class="gif-frames '.$class.'">';
  $html .= do_shortcode( $content );
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode('gif-frames','callback_gif_frames' );

function callback_gif_frame($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'image' => ''
  ), $atts ));

  global $GIF_FRAME_TOTAL;
  global $GIF_FRAME_COUNT;

  $html = '';

  $html .= '<div class="gif-frame '.$class.'">';
  $html .= do_shortcode( '[image id="'.$image.'" size="full"]' );
  $html .= '</div>';

  $GIF_FRAME_COUNT++;

  if($GIF_FRAME_COUNT < $GIF_FRAME_TOTAL){
      $html .= '<span class="gif-frame-separator">+</span>';
  }

  return force_balance_tags( $html );
}
add_shortcode('frame','callback_gif_frame' );




?>
