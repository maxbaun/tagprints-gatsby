<?php

function callback_landing_page_map($atts,$content=null){
  extract(shortcode_atts( array(
    'image' => '',
    'text' => '',
    'icons' => '',
    'icon_widths' => '',
    'icon_heights' => ''
  ), $atts ));


  $textArr = explode(',',$text);
  $iconArr = explode(',',$icons);
  $widthArr = explode(',',$icon_widths);
  $heightArr = explode(',',$icon_heights);

  $html = '<div class="landing-page-map">';

  $html .= '<div class="landing-page-map-image">';
  $html .= imageShortcode($image,'landing-photobooth');
  $html .= '</div>';

  $count = 1;
  foreach($iconArr as $i){
    $html .= '<div class="landing-page-map-content-'.$count.'">';
    // $bgStyle = iconBackgroundImage($i,'landing-page-map-icon');
    // var_dump($i);
    $bgStyle = retinaImageStyle(intval($i),'full');
    $bgImgData = getImage($i,'landing-page-map-icon');

    $html .= $bgStyle;

    $iconWidth = (isset($widthArr[$count-1]) && $widthArr[$count-1] > 0) ? $widthArr[$count-1] : iconWidth($i);
    $iconHeight = (isset($heightArr[$count-1]) && $heightArr[$count-1] > 0) ? $heightArr[$count-1] : iconHeight($i);

    $icon = iconShortcode($i,$iconWidth, $iconHeight);



    $html .= '<div class="landing-page-map-icon">'.$icon.'</div>';
    $html .= '<div class="landing-page-map-separator" style="width:'.$iconWidth.'px;" ></div>';
    $html .= '<p class="landing-page-map-text">'.$textArr[$count-1].'</p>';
    $html .= '</div>';
    $count++;
  }

  $html .= '</div>';

  return force_balance_tags($html);
}

add_shortcode('landing-page-map','callback_landing_page_map' );

?>
