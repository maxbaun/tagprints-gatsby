<?php

function callback_featured_home($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => '',
    'cta_text' => '',
    'cta_link' => '',
    'image' => '',
    'show_cta' => 'false',
    'center_content' => 'false'
  ), $atts ));

  $html = '';

  $bgImgStyle = backgroundImageStyle($image,'featured-home');

  $html .= $bgImgStyle;

  ob_start();
  echo $bgImgStyle;
  ?>
  <div class="featured-home">
    <div class="featured-home-inner">
      <div class="header" id="bgimage-<?php echo $image; ?>">
        <h3 class="title"><?php echo $title; ?></h3>
      </div>
      <?php if(isset($center_content) && $center_content != 'false'): ?>
      <div class="content content-center-wrapper">
      <?php else: ?>
      <div class="content">
      <?php endif; ?>
      <?php if(isset($center_content) && $center_content != 'false'): ?>
        <div class="content-center">
          <?php echo do_shortcode($content); ?>
        </div>
      <?php else: ?>
        <?php echo do_shortcode($content); ?>
      <?php endif;?>
        <div class="content-base">
        <?php if(isset($show_cta) && $show_cta != 'false'):
          echo do_shortcode('[cta text="'.$cta_text.'" link="'.$cta_link.'" center="false" class="btn btn-cta-transparent readmore"][/cta]');
        endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  // $html .= '<div class="featured-home">';
  // $html .= '<div class="featured-home-inner">';

  // $html .= '<div class="header" id="bgimage-'.$image.'">';
  // $html .= '<h3 class="title">' . $title . '</h3>';
  // $html .= '</div>';

  // if(isset($center_content) && $center_content != 'false')
  //   $html .= '<div class="content content-center-wrapper">';
  // else
  //   $html .= '<div class="content">';

  // if(isset($center_content) && $center_content != 'false'){
  //   $html .= '<div class="content-center">';
  //   $html .= do_shortcode($content);
  //   $html .= '</div>';
  // }
  // else{
  //   $html .= do_shortcode($content);
  // }
  // $html .= '<div class="content-base">';
  // if(isset($show_cta) && $show_cta != 'false'){
  //   $html .= do_shortcode('[cta text="'.$cta_text.'" link="'.$cta_link.'" center="false" class="btn btn-cta-transparent readmore"][/cta]');
  // }
  // $html .= '</div>';
  // $html .= '</div>';

  // $html .= '</div>';
  // $html .= '</div>';

  $html = ob_get_clean();
  return force_balance_tags( $html );
}
add_shortcode( 'featured-home','callback_featured_home' );

function callback_featured_home_wrapper($atts,$content=null){

  $html = '<div class="featured-home-wrapper">';
  $html .= do_shortcode($content);
  $html .= '</div>';
  return force_balance_tags($html);

}
add_shortcode( 'featured-home-wrapper','callback_featured_home_wrapper' );

?>
