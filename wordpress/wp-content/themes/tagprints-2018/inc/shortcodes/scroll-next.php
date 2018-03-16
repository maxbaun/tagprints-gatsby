<?php

function scroll_next($atts,$content=null){
  extract(shortcode_atts( array(
    'section' => '',
    'bottom' => '60px',
    'color' => '#ffffff',
  ), $atts ));


  $wrapperStyle = 'bottom: ' . $bottom . ';';
  $scollNextStyle = 'color: ' . $color . '; border-color: ' .$color.';';
  $iconStyle = 'color: ' . $color . ';';

  $html = '';

  $html .= '<div class="scroll-next-wrapper" style="'.$wrapperStyle.'">';

  $html .= '<a class="scroll-next" data-scroll="'.$section.'" style="'.$scollNextStyle.'"><span class="fa fa-angle-down" style="'.$iconStyle.'"></span></a>';

  $html .= '</div>';

  return force_balance_tags($html);
}

add_shortcode('scroll-next','scroll_next' );

?>
