<?php


function callback_case_study_block($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => ''

  ), $atts ));


  $html = '<div class="case-study-block '.$class.'" style="'.$style.'">'; // case study block

  if(isset($title) && $title != ''){
      $html .='<h5 class="title"><strong>'.$title.'</strong></h5>';
  }
  $html .= '<div class="text">' . do_shortcode( $content ) . '</div>';

  $html .= '</div>'; //case study block

  return force_balance_tags( $html );
}
add_shortcode( 'case-study-block' , 'callback_case_study_block' );

function callback_section_case_study_header($atts,$content=null){

  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'image' => '',
    'logo' => '',
    'title' => '',
    'subtitle' => '',
    'cta_text' => '',
    'cta_link' => '',
    'background_image' => '',
    'theme' => 'dark',
    'background_size' => '',
    'min_height' => '',
    'layout' => '',
    'title_color' => '',
    'scroll' => ''

  ), $atts ));


  if(isset($title_color) && $title_color != '')
    $brandColor = $title_color;
  else
    $brandColor = brandColor();

  $bgImgStyle = backgroundImageStyle($background_image,'hero');

  if(isset($background_size) && $background_size != '')
    $style .= ' background-size: ' . $background_size .' !important;';
  // if(isset($min_height) && $min_height != '')
    // $style .= ' min-height: ' . $min_height .' !important;';

  $imgData = getImage($background_image,'hero');

  if(isset($layout) && $layout == 'image')
    $theme .= ' just-image';

  $html = '';
  if(isset($layout) && $layout != 'image')
    $html .= $bgImgStyle;
  $html .= '<section id="bgimage-'.$background_image.'" class="case-study-header '.$theme.'" style="'.$style.'">'; //case-study-header
  $html .= '<div style="max-height:100%;">';

  if(isset($scroll) && $scroll){
      $html .= do_shortcode('[scroll-next section="'.$scroll.'" bottom="30px"][/scroll-next]');
  }

  if(isset($layout) && $layout == 'image')
    $html .= '<img class="background-image" src="'.$imgData['src'].'"/>';
  $html .= '<div class="overlay">';
  $html .= '<div class="container">';
  $html .= '<div class="vertical-center">';
  $html .= '<div class="vertical-center-inner">';
  $html .= '<h1 class="title" style="color:'.$brandColor.';">'.$title.'</h1>';
  $html .= '<h3 class="subtitle">'.$subtitle.'</h3>';

  $html .= do_shortcode( $content );

  $html .= '</div>'; //vertical-center-inner
  $html .= '</div>'; //vertical-center

  $html .= '</div>'; //container
  $html .= '</div>'; //overlay

  $html .= '</div>';
  $html .= '</section>'; //case-study-header

  return force_balance_tags( $html );
}
add_shortcode( 'section-case-study-header' , 'callback_section_case_study_header' );



?>
