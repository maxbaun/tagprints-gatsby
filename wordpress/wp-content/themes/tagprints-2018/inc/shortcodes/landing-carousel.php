<?php


function callback_landing_carousel($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'multiple' => 'false',
    'index' => '',
    'mobile_help' => ''

  ), $atts ));

  $html = '';

  //if contain
  if(isset($contain) && $contain == 'true')
    $html .= '<div class="row"><div class="'.get_container_class().'">';


  $multipleClass = (isset($multiple) && $multiple === 'true') ? 'multiple' : '';
  $class .= ' ' . $multipleClass;

  $carouselOptions = array(
    'imagesLoaded' => true,
    'contain' => false,
    'wrapAround' => true,
    'initialIndex' => (isset($index)) ? $index : 0
  );

  $json = json_encode($carouselOptions);

  $html .= "<div class='carousel js-flickity ".$class."' data-flickity-options='".$json."'>";
  $html .= do_shortcode($content);
  $html .= '</div>';
  if(isset($mobile_help) && $mobile_help != ''){
      $html .= "<p class='visible-xs text-center mobile-help' style='margin-top:10px;'>".$mobile_help."</p>";
  }


  if(isset($contain) && $contain == 'true')
    $html .= '</div></div>';

  return force_balance_tags( $html );
}
add_shortcode( 'landing-carousel' , 'callback_landing_carousel' );

function callback_landing_carousel_item($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'text' => '',
    'image' => '',
    'image_size' => 'landing-photobooth',
    'icon' => '',
    'icon_width' => '',
    'icon_height' => '',

  ), $atts ));

  $html = '';

  $imgData = getImage($image,$image_size);

  $html .= '<div class="carousel-cell">';
  if(isset($image) & $image != ''){
      $html .= imageShortcode($image,$image_size);

  } else if(isset($icon) && $icon != ''){
      $html .= iconShortcode($icon, $icon_width, $icon_height, true);
  }
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'landing-carousel-item' , 'callback_landing_carousel_item' );

// function callback_landing_carousel($atts,$content=null){
//   extract(shortcode_atts( array(
//     'class' => '',
//     'style' => '',
//     'title' => '',
//     'contain' => 'false',
//     'id' => '',
//     'show_arrows' => 'true',
//     'auto_play' => '50000000',
//     'size' => '0'
//
//   ), $atts ));
//
//   $html = '';
//
//   $sizeAttr = ($size != '0') ? 'carousel-size="' . $size . '"' : '';
//
//   if(isset($id) && $id != '')
//     $carouselId = $id;
//   else
//     $carouselId = 'carousel-' . rand(0,100);
//
//   if(isset($contain) && $contain == 'true')
//     $html .= '<div class="row"><div class="'.get_container_class().'">';
//
//   if($size != '0')
//     $multipleClass = 'multiple';
//
//   $html .= '<div id="'.$carouselId.'" class="carousel slide landing-carousel '.$multipleClass.'" '.$sizeAttr.' data-ride="carousel" data-interval="'.$auto_play.'">';
//   $html .= '<div class="carousel-inner" role="listbox">';
//   $html .= do_shortcode($content);
//   $html .= '</div>';
//
//   if(isset($show_arrows) && $show_arrows != 'false'){
//     $html .= '
//     <a class="left carousel-control" href="#'.$carouselId.'" role="button" data-slide="prev">
//       <span class="fa fa-angle-left" aria-hidden="true"></span>
//       <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
//       <span class="sr-only">Previous</span>
//     </a>
//     <a class="right carousel-control" href="#'.$carouselId.'" role="button" data-slide="next">
//       <span class="fa fa-angle-right" aria-hidden="true"></span>
//       <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
//       <span class="sr-only">Next</span>
//     </a>';
//   }
//
//   $html .= '</div>';
//
//   if(isset($contain) && $contain == 'true')
//     $html .= '</div></div>';
//
//   return force_balance_tags( $html );
// }
// add_shortcode( 'landing-carousel' , 'callback_landing_carousel' );

// function callback_landing_carousel_item($atts,$content=null){
//   extract(shortcode_atts( array(
//     'class' => '',
//     'style' => '',
//     'title' => '',
//     'text' => '',
//     'active' => '',
//     'image' => '',
//     'image_size' => 'full'
//
//   ), $atts ));
//
//   $html = '';
//
//   $imgData = getImage($image,$image_size);
//
//
//   $activeClass = '';
//   if(isset($active) && $active == 'true')
//   	$activeClass = 'active';
//
//   $html .= '<div class="item '.$activeClass.'" style="'.$style.'">';
//   $html .= do_shortcode($content);
//   $html .= '</div>';
//
//   return force_balance_tags( $html );
// }
// add_shortcode( 'landing-carousel-item' , 'callback_landing_carousel_item' );


?>
