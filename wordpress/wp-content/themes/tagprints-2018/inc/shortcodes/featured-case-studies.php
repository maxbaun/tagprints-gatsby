<?php


function callback_case_study_large($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'image' => '',
    'logo' => '',
    'title' => '',
    'cta_text' => '',
    'cta_link' => '',
    'background_image' => '',
    'text' => ''

  ), $atts ));

  // $bgImg = getImage($background_image,'featured-case-study-bg');
  // $style .= ' background-image:url('.$bgImg['src'].');';

  $bgImgStyle = backgroundImageStyle($background_image,'large', true);

  $html = '';
  $html .= $bgImgStyle;
  $html .= '<div id="bgimage-'.$background_image.'" class="case-study-large" style="'.$style.'">'; // case study large

  $html .='<div class="case-study-inner">'; // case study inner
  $html .= '<div class="graphic">';
  $html .= do_shortcode($content);//content
  $html .= '</div>';
  $html .= '<div class="content">'; // content
  $html .= '<div class="logo">'.do_shortcode( '[image id="'.$logo.'" size="mini-small"][/image]' ).'</div>';//logo
  $html .= '<div class="title">'.$title.'</div>'; //title
  $html .= '<div class="text">'.$text.'</div>';//text
  $html .= do_shortcode( '[cta class="btn-cta-transparent" text="'.$cta_text.'" link="'.$cta_link.'"][/cta]' ); //call to action
  $html .='</div>'; // content
  $html .='</div>'; // case study inner

  $html .= '</div>'; //case study large

  return force_balance_tags( $html );
}
add_shortcode( 'case-study-large' , 'callback_case_study_large' );

function callback_case_study($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'image' => '',
    'logo' => '',
    'logo_type' => 'image',
    'title' => '',
    'subtitle' => '',
    'cta_text' => 'Learn More',
    'cta_link' => '',
    'background_image' => '',
    'text' => ''

  ), $atts ));

  global $TOTAL_FEATURED_CASE_STUDIES;

  $background_style = backgroundImageStyle($image, 'case-study-medium', true);
  $imageId = $image;

  $logo_html = '';
  $logo_height = '';
  $logo_width = '';
  $logo_content = '';

  if(isset($logo) && $logo != ''){
      if($logo_type == 'svg'){
          $icon = get_post($logo);
          $logo_width = get_post_meta($logo, 'default_width', true);
          $logo_height = get_post_meta($logo, 'default_height', true);
          $logo_content .= $icon->post_content;
      } else{
          $image = getImage($logo, 'small');
          $logo_width = $image['width'];
          $logo_height = $image['height'];
          $logo_content .= '<img src="'.$image['src'].'" srcset="'.$image['srcset'].'"/>';
      }
  }

  $logo_html = '<div class="logo-image text-center" style="width:'.$logo_width.'px; height:'.$logo_height.'px;">';
  $logo_html .= $logo_content;
  $logo_html .= '</div>';

  $html = $background_style;


  $data_href_html = '';
  if(isset($cta_link) && $cta_link){
      $data_href_html = 'data-href="'.$cta_link.'"';
  }

  $html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">'; // columm
  $html .= '<div class="case-study" '.$data_href_html.'>'; // case-study

  $html .= '<div class="preview" id="bgimage-'.$imageId.'">';

  $html .= '<div class="logo">';
  $html .= '<div class="vertical-center text-center">';
  $html .= '<div class="vertical-center-inner">';
  $html .= $logo_html;
  if(isset($text) && $text != ''){
      $html .= '<p class="text">' . $text . '</p>';
  }
  $html .= '</div>'; // vertical-center-inner
  $html .= '</div>'; //vertical-center
  $html .= '</div>';

  if(isset($cta_link) && $cta_link){
      $html .= '<div class="overlay">';
      $html .= '<div class="vertical-center text-center">';
      $html .= '<div class="vertical-center-inner">';
      $html .= do_shortcode( '[cta class="btn-cta-white" center="false" text="'.$cta_text.'" link="'.$cta_link.'"][/cta]' );
      $html .= '</div>'; // vertical-center-inner
      $html .= '</div>'; //vertical-center
      $html .= '</div>'; // overlay
  }

  if(!$cta_link){
      $html .= '<div class="coming-soon"><div class="vertical-center"><div class="vertical-center-inner"><span class="coming-soon-text">Coming<br/>Soon</span></div></div></div>';
  }

  $html .= '</div>'; // preview
  // $html .= '<div class="thumbnail">'.do_shortcode( '[image id="'.$logo.'" size="small"][/image]' ).'</div>'; //thumbnail

  $html .= '<div class="content">';
  if( (isset($title) || isset($subtitle)) && ($title != '' || $subtitle != '')){

      $html .= '<p class="title">' . $title . '</p>';
      $html .= '<p class="subtitle">' . $subtitle . '</p>';
  }
  $html .= '</div>'; //content


  $html .= '</div>'; // case-study

  $html .= '</div>';

  $TOTAL_FEATURED_CASE_STUDIES++;

  return force_balance_tags( $html );
}
add_shortcode( 'case-study' , 'callback_case_study' );

function callback_featured_case_studies($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'contain' => 'true'
  ), $atts ));

  global $TOTAL_FEATURED_CASE_STUDIES;
  $TOTAL_FEATURED_CASE_STUDIES = 1;

  $html = '';
  if(isset($contain) && $contain =='true')
    $html .= '<div class="'.get_container_class().'">';

  $html .= '<div class="featured-case-studies">' . do_shortcode( $content ) . '</div>';

  if(isset($contain) && $contain =='true')
    $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'featured-case-studies' , 'callback_featured_case_studies' );

?>
