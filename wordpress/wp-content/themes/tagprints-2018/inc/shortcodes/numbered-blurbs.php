<?php

function callback_numbered_blurbs($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => 'white',
    'style' => '',
  ), $atts ));  

  $html = '<div class="numbered-blurbs '.$class.'" style="'.$style.'">';
  $html .= do_shortcode( $content );
  $html .= '</div>';

  return force_balance_tags($html);
}

add_shortcode('numbered-blurbs','callback_numbered_blurbs' );

function callback_blurb($atts,$content){
  extract(shortcode_atts( array(
    'class' => 'white',
    'style' => '',
    'image' => '',
    'value' => '',
    'text'  => ''
  ), $atts ));


  $html = '<div class="numbered-blurb">';

  $html .= do_shortcode('
    <div class="blurb">
      <div class="blurb-inner">'.$text.'</div>
    </div>
    <span class="value">'.$value.'</span>
    <div class="bullet"></div>
    <div class="image">
      [image id="'.$image.'" size="small" valign="true"][/image]
    </div>

  ');  

  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode('blurb','callback_blurb' );


?>