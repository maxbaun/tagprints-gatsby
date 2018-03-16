<?php

function callback_gif_facts($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'count' => ''
  ), $atts ));

  global $GIF_FACT_TOTAL;
  global $GIF_FACT_COUNT;

  $GIF_FACT_COUNT = 0;
  $GIF_FACT_TOTAL = (empty($count)) ? 1 : intval($count);

  $html = '';

  $html .= '<div class="gif-facts '.$class.'">';
  $html .= do_shortcode( $content );
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode('gif-facts','callback_gif_facts' );

function callback_gif_fact($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'icon' => '',
    'text' => ''
  ), $atts ));

  global $GIF_FACT_TOTAL;
  global $GIF_FACT_COUNT;

  $html = '';

  $html .= '<div class="gif-fact '.$class.'">';
  if(!empty($icon)){
      $html .= do_shortcode('[icon id="'.$icon.'"]');
  }
  $html .= '<span class="gif-fact-text">' . $text . '</span>';
  $html .= '</div>';

  $GIF_FACT_COUNT++;

  if($GIF_FACT_COUNT < $GIF_FACT_TOTAL){
      $html .= '<span class="gif-fact-separator"></span>';
  }

  return force_balance_tags( $html );
}
add_shortcode('fact','callback_gif_fact' );




?>
