<?php


function callback_carousel($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'contain' => 'false',
    'id' => '',
    'show_arrows' => 'true',
    'border' => 'true',
    'auto_play' => '5000'

  ), $atts ));

  $html = '';

  $borderTop = ($border == 'true') ? 'border-top' : '';

  if(isset($id) && $id != '')
    $carouselId = $id;
  else
    $carouselId = 'carousel-' . rand(0,100);

  if(isset($contain) && $contain == 'true')
    $html .= '<div class="row"><div class="'.get_container_class().'">';

  $html .= '<div id="'.$carouselId.'" class="carousel slide '.$borderTop.'" data-ride="carousel" data-interval="'.$auto_play.'">';
  $html .= '<div class="carousel-inner" role="listbox">';

  $html .= do_shortcode($content);
  $html .= '</div>';

  if(isset($show_arrows) && $show_arrows != 'false'){
    $html .= '
    <a class="left carousel-control" href="#'.$carouselId.'" role="button" data-slide="prev">
      <span class="fa fa-angle-left" aria-hidden="true"></span>
      <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#'.$carouselId.'" role="button" data-slide="next">
      <span class="fa fa-angle-right" aria-hidden="true"></span>
      <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
      <span class="sr-only">Next</span>
    </a>';
  }

  $html .= '</div>';

  if(isset($contain) && $contain == 'true')
    $html .= '</div></div>';

  return force_balance_tags( $html );
}
add_shortcode( 'carousel' , 'callback_carousel' );

function callback_slide($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'text' => '',
    'active' => '',
    'image' => '',
    'data_top' => '0',
    'background_image' => '',
    'mobile_background_image' => '',
    'image_size' => 'full'

  ), $atts ));

  $html = '';

  $imgData = getImage($image,$image_size);

  $mobile_background_image_data = array(
      'id' => $mobile_background_image,
      'size' => 'carousel-mobile'
  );

  $bgImgStyle = backgroundImageStyle($background_image,'carousel', false, $mobile_background_image_data);
  $bgImgData = getImage($background_image,'carousel');

  $activeClass = '';
  if(isset($active) && $active == 'true')
  	$activeClass = 'active';

  $padding = floatval($data_top ) * floatval($imgData['height']);
  $padding = 300 - $padding;
  // $style .= ' padding-top: ' . $padding .'px;';

  $style .= ' height: ' . $bgImgData['height'] . 'px; ';

  $html .= $bgImgStyle;
  if(isset($background_image) && $background_image != '')
    $html .= '<div id="bgimage-'.$background_image.'" class="item '.$activeClass.'" style="'.$style.'" data-top="'.$data_top.'">';
  else
    $html .= '<div class="item '.$activeClass.'" style="'.$style.'" data-top="'.$data_top.'">';


  $html .= '<div class="carousel-inner-wrapper">'; // inner wrapper
  $html .= '<div class="carousel-content">';
  $html .= do_shortcode($content);
  $html .= '</div>';
  $html .= '<div class="carousel-image">';


  $imgLayout = ($imgData['width'] > $imgData['height']) ? 'image-landscape' : 'image-portrait';
  $html .= '<img class="'.$imgLayout.'" src="'.$imgData['src'].'" data-width="'.$imgData['width'].'" data-height="'.$imgData['height'].'"/>';
  $html .= '</div>';
  $html .= '</div>'; // inner wrapper
  // $html .= '<div class="carousel-caption">';
  // $html .= do_shortcode($content);
  // $html .= '</div>';


  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'slide' , 'callback_slide' );

function callback_featured_slide($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'active' => '',
    'image' => '',
    'image_size' => 'full',
    'contain' => 'false'

  ), $atts ));

  $html = '';

  $imgData = getImage($image,$image_size);

  $activeClass = '';
  if(isset($active) && $active == 'true')
    $activeClass = 'active';

  // $style .= ' padding-top: ' . $padding .'px;';

  $html .= '<div class="item item-featured '.$activeClass.'" style="'.$style.'">';

  if(isset($contain) && $contain == 'true')
    $html .= '<div class="row"><div class="'.get_container_class().'">';

  $html .= '<div class="carousel-image">';


  $html .= '<img src="'.$imgData['src'].'" width="'.$imgData['width'].'" height="'.$imgData['height'].'" data-width="'.$imgData['width'].'" data-height="'.$imgData['height'].'"/>';
  $html .= '</div>';
  // $html .= '<div class="carousel-content">';
  // $html .= do_shortcode($content);
  // $html .= '</div>';

  if(isset($contain) && $contain == 'true')
    $html .= '</div></div>';
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'featured-slide' , 'callback_featured_slide' );


?>
