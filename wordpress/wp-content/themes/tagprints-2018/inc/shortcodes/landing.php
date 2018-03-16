<?php

function landing_hero($atts,$content=null){
  extract(shortcode_atts( array(
    'image' => '',
    'overlay' => null,
    'overlay_opacity' => '.7',
    'background_size' => 'cover',
    'background_color' => 'transparent'

  ), $atts ));

  $bgImgStyle = backgroundImageStyle($image,'hero');

  $style = 'background-size: '.$background_size.'; min-height: 100%; background-position: center; background-repeat: no-repeat;';
  $style .= ' background-color: ' . $background_color . ';';

  $html = $bgImgStyle;
  $html .= '<div class="landing-hero" id="bgimage-'.$image.'" style="'.$style.'">';
  if(isset($overlay)){
    $html .= '<div class="landing-overlay" style="background-color: '.$overlay.'; opacity: '.$overlay_opacity.';"></div>';
  }
  $html .= do_shortcode( $content );

  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'landing-hero' , 'landing_hero' );

function landing_hero_content($atts,$content=null){
  extract(shortcode_atts( array(
    'title' => 'What is TagPrints?',
    'subtitle' => '',
    'text' => '',
    'title_color' => '',
    'button' => '',
    'link' => '',
    'modal' => null,
    'form' => null,
    'form_title' => '',
    'form_background' => '',
    'form_color' => '',
    'form_title_color' => '',
    'form_title_background' => '',
    'form_input_background' => '',
    'form_tabindex' => '1'

  ), $atts ));

  $subtitle_html = '';
  if(isset($subtitle) && $subtitle != ''){
      $subtitle_html = '<span class="subtitle">' . $subtitle . '</span>';
  }

  $title_style = ' style="';
  if(isset($title_color) & $title_color != ''){
      $title_style .= 'color: ' . $title_color;
  }

  $title_style .= '"';

  $classes = '';
  if(isset($form) && $form != ''){
      $classes .= ' has-form';
  }

  $html = '<div class="landing-hero-content '.$classes.'">';
  $html .= '<div class="vertical-center">';
  $html .= '<div class="vertical-center-inner">';

  if(isset($form) && $form != ''){
      $html .= '<div class="container">';
  }

  if(isset($form) && $form != ''){
      $html .= '<div class="content">';
  }

  $html .= '<h1 '.$title_style.'>'.$title.$subtitle_html.'</h1>';
  $html .= '<p class="landing-text" '.$title_style.'>'.$text.'</p>';

  if(isset($button) && $button != ''){
      $html .= '<div class="separator"></div>';
      $html .= do_shortcode("[cta text='$button' modal='$modal' link='$link' center='false']");
  }

  if(isset($form) && $form != ''){
      $html .= '</div>';
  }

  $form_id = 'form-' . rand(0,100);

  $form_style = '<style type="text/css">
    #'.$form_id.'{
        background-color: '.$form_background.';
        color: '.$form_color.';
    }
    #'.$form_id.' .form-title{
        background-color: '.$form_title_background.';
        color: '.$form_title_color.';
    }
    #'.$form_id.' input[type="text"],
    #'.$form_id.' input[type="email"],
    #'.$form_id.' textarea,
    #'.$form_id.' input[type="text"]:focus,
    #'.$form_id.' input[type="email"]:focus,
    #'.$form_id.' textarea:focus{
        border-color: '.$form_color.';
        color: '.$form_color.';
        background-color: '.$form_input_background.';
    }

    #'.$form_id.' ::-webkit-input-placeholder {
      color: '.$form_color.';
    }

    #'.$form_id.' :-moz-placeholder { /* Firefox 18- */
      color: '.$form_color.';
    }

    #'.$form_id.' ::-moz-placeholder {  /* Firefox 19+ */
      color: '.$form_color.';
    }

    #'.$form_id.' :-ms-input-placeholder {
      color: '.$form_color.';
    }
  </style>';

  $html .= $form_style;

  if(isset($form) && $form != ''){
      $html .= '<div id="'.$form_id.'" class="form">';
      $html .= '<h3 class="form-title">'.$form_title.'</h3>';
      $html .= do_shortcode('[gravityform id="'.$form.'" title="false" description="false" ajax="false" tabindex="'.$form_tabindex.'"]');
      $html .= '</div>';
  }

  if(isset($form) && $form != ''){
      $html .= '</div>';
  }

  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>'; //case study block

  return force_balance_tags( $html );
}
add_shortcode( 'landing-hero-content' , 'landing_hero_content' );

?>
