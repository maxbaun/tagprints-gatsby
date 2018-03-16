<?php

function callback_service_header($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => 'white',
    'style' => '',
    'title' => '',
    'subtitle' => '',
    'image' => '',
    'image2' => '',
  ), $atts ));  

  $imgData = wp_get_attachment_image_src( $image,'large');
  $imgSrc = $imgData[0];

  $section = do_shortcode('[section class="service-header '.$class.'" contain="true"]
    <div class="vertical-align">
    <div class="left">[title text="'.$title.'" shape="true"][/title]</div>
    <div class="right">[subtitle text="'.$subtitle.'"][/subtitle]</div>
    </div>
    <div class="vertical-align">
      <div class="left">
        <div class="thumbnail">[image id="'.$image.'" size="service-header" ][/image]</div>
      </div>
      <div class="right"><div class=""></div>'.$content.'</div>
    </div>


  [/section]' );

  $html = $section;

  return force_balance_tags($html );
}
add_shortcode('service-header','callback_service_header');
?>