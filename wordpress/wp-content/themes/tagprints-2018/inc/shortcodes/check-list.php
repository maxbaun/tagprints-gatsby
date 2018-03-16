<?php

function callback_check_list($atts,$content=null){
  extract(shortcode_atts( array(
  ), $atts ));


  $html = '<ul class="check-list">';
  $html .= do_shortcode($content);
  $html .= '</ul>';

  return force_balance_tags($html);
}

add_shortcode('check-list','callback_check_list' );

function callback_check_list_item($atts,$content=null){
  extract(shortcode_atts( array(
  ), $atts ));


  $html = '<li class="check-list-item">';
  $html .= do_shortcode($content);
  $html .= '</li>';

  return force_balance_tags($html);
}

add_shortcode('check-list-item','callback_check_list_item' );

?>
