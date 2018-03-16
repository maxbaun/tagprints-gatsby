<?php

function callback_tagprints_image_fade($attrs, $content = null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'speed' => 1000
  ), $attrs ));

  $html = '';

  $html .= '<div class="image-fade" data-speed="'.$speed.'" style="'.$style.'">';
  $html .= do_shortcode($content);
  $html .= '</div>';

  return force_balance_tags($html);
}

add_shortcode('image-fade','callback_tagprints_image_fade');


?>
