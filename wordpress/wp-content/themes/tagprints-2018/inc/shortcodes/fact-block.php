<?php

function callback_fact_block($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => ''

  ), $atts ));


  $html = '<div class="fact-block '.$class.'" style="'.$style.'">'; // fact block
  $html .= do_shortcode( $content );
  $html .= '</div>'; //case study block

  return force_balance_tags( $html );
}
add_shortcode( 'fact-block' , 'callback_fact_block' );

function callback_fact($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'number' => '',
    'text_upper'=>'',
    'text_lower'=>'',
    'width'=> '',
    'color' => ''

  ), $atts ));

  if(isset($width)){
    $style .= 'width:'.$width.';';
  }

  $brandColor = $color;
  if(!isset($color) || $color == '')
    $brandColor = brandColor();

  $html = '<div class="fact '.$class.'" style="'.$style.'">'; // fact block
  $html .= '<div class="fact-inner">'; //fact inner
  $html .= '<div class="left">'; //left
  $html .= '<div class="number" style="color:'.$brandColor.';">' . $number . '</div>'; //number
  $html .= '</div>'; //left
  $html .= '<div class="right">';//right
  $html .= '<div class="text-upper" style="color:'.$brandColor.';">' . $text_upper . '</div>'; //text upper
  $html .= '<div class="text-lower">' . $text_lower . '</div>'; // text lower
  $html .= '</div>'; //right
  $html .= '</div>'; // fact inner
  $html .= '</div>'; //case study block

  return force_balance_tags( $html );
}
add_shortcode( 'fact' , 'callback_fact' );

?>