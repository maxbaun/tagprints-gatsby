<?php

function callback_landing_quote($atts,$content=null){
  extract(shortcode_atts( array(
    'image' => '',
    'title' => '',
    'position' => '',
  ), $atts ));

  $html = '<div class="landing-quote">';

  $html .= '<div class="landing-quote-bubble">';
  $html .= '<p class="landing-quote-content">'.$content.'</p>';
  $html .= '</div>';


  $bgImgData = getImage($image,'landing-quote-thumbnail');
  $bgStyle = backgroundImageStyle(intval($image),'landing-quote-thumbnail');

  $html .= $bgStyle;
  $html .= '<div class="landing-quote-info-wrapper">';
  $html .= '<div class="landing-quote-thumbnail" id="bgimage-'.$image.'" style="background-repeat: no-repeat; height: '.$bgImgData['height'].'px; width: '.$bgImgData['width'].'px;"></div>';
  $html .= '<div class="landing-quote-info">';

  if(isset($title) && $title != ''){
    $html .= '<p class="landing-quote-title">'.$title.'</p>';
  }

  if(isset($position) && $position != ''){
    $html .= '<p class="landing-quote-position">'.$position.'</p>';
  }

  $html .= '</div>';
  $html .= '</div>';

  $html .= '</div>';

  return force_balance_tags($html);
}

add_shortcode('landing-quote','callback_landing_quote' );

?>
