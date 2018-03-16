<?php

function callback_media($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => 'white',
    'style' => '',
    'media_type' => '',
    'image' => '',
    'vimeo_src' => '',
    'contain' => 'true'
  ), $atts ));

  $html = '';
  // start media content

  if(isset($contain) && $contain=='true')
    $html .='<div class="row"><div class="'.get_container_class().'">';

  if($media_type=='video'){
    $html .= '<div class="video embed-responsive embed-responsive-16by9 text-center">';
    $html .= '<iframe src="'.$vimeo_src.'"></iframe>';
  }
  else{
    $html .= '<div class="text-center">';
    $html .= do_shortcode('[image id="'.$image.'" size="medium"][/image]');
  }
  $html .= '</div>';
  // end media content

  if(isset($contain) && $contain=='true')
    $html .= '</div></div>';

  return force_balance_tags( $html );
}
add_shortcode( 'media' , 'callback_media' );

function callback_feature($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'data_slide_index' => '',
    'data_carousel' => ''
  ), $atts ));

  $html = '';

  if(isset($data_slide_index) && $data_slide_index != ''){
    $class .= ' carousel-nav';
    $html .= '<li class="'.$class.'"><a href="'.$data_carousel.'" data-slide-index="'.$data_slide_index.'">' . $content . '</a></li>';
  }
  else
    $html .= '<li class="'.$class.'">' . $content . '</li>';

  return force_balance_tags( $html );
}
add_shortcode( 'feature' , 'callback_feature' );

function callback_features($atts,$content=null){

  $html = '<ul class="features">' . do_shortcode( $content ) . '</ul>';

  return force_balance_tags( $html );
}
add_shortcode( 'features' , 'callback_features' );

?>
