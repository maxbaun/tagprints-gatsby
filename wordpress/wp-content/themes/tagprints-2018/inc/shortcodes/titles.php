<?php

function callback_title($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'text' => '',
    'subtitle' => '',
    'subtitle_class' => '',
    'shape' => 'false',
    'contain' => 'false',
    'contain_class' => 'col-md-6',
    'type' => 'text',
    'title_image' => '',
    'title_image_size' => 'medium',
    'color' => '',
    'font_family' => '',
    'center' => 'true'
  ), $atts ));

  if(isset($shape) && $shape =='true')
    $class = 'shape-bg';

  $html = '';

  $hasBorder = strpos($class, 'title-border') !== false ? true:false;

  if(isset($color) && $color != '')
    $style .= ' color: ' . $color . ';';

  if(isset($font_family) && $font_family != '')
    $style .= ' font-family: ' . $font_family . ';';


  if(isset($center) && $center == 'true')
    $class .= ' text-center';
  else
    $class .= ' text-left';


  $text = str_replace('%heart%','<span class="fa fa-heart-o"></span>',$text);

  if(isset($contain) && $contain == 'true')
    $html .= '<div class="row"><div class="'.$contain_class.'">'; //row & column container

  if(isset($subtitle) && $subtitle != '' && !$hasBorder)
    $class .= ' has-subtitle ';


  $subtitle_html = '';
  if(isset($subtitle) && $subtitle != '' && $hasBorder){
      $subtitle_html = '<span class="subtitle">'.$subtitle.'</span>';
  }

  if(isset($type) && $type == 'text')
    $html .= do_shortcode('<h1 class="'.$class.' title" style="'.$style.'">'.$text.$subtitle_html.'</h1>');
  else if(isset($type) && $type == 'image')
    $html .= '<div class="title title-image text-center" style="'.$style.'">' . do_shortcode('[image id="'.$title_image.'" size="'.$title_image_size.'"][/image]') . '</div>';//title

  if(isset($subtitle) && $subtitle != '' && !$hasBorder)
    $html .= '<h5 class="subtitle '.$subtitle_class.'">'.$subtitle.'</h5>';


  if(isset($contain) && $contain == 'true')
    $html .= '</div></div>'; //row & column container
  return force_balance_tags( do_shortcode($html) );
}

add_shortcode( 'title', 'callback_title' );

function callback_subtitle($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'text' => ''
  ), $atts ));

  $html = '<h3 class="'.$class.' subtitle">'.$text.'</h3>';
  return force_balance_tags( $html );
}

add_shortcode( 'subtitle', 'callback_subtitle' );

?>
