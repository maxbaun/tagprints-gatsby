<?php


function callback_section($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => 'white',
    'style' => '',
    'container' => 'true',
    'bottom_image' => '',
	'bottom_image_size' => 'large',
	'bottom_image_extend_top' => '',
	'bottom_image_class' => '',
    'background_image' => '',
    'background_height_add' => 0,
    'id' => ''
  ), $atts ));

  $imgData = wp_get_attachment_image_src( $bottom_image,'large');
  $imgSrc = $imgData[0];

  if(isset($background_image) && $background_image != '')
    $style .= ' ' . getImageBackgroundStyle($background_image,false,$background_height_add, false);

  //section
  $html = '<section class="'.$class.'" style="'.$style.'" id="'.$id.'">';
  // container
  if($container == 'true')
    $html .= '<div class="container">';

  $html .= do_shortcode( $content );

  // end container
  if($container == 'true')
    $html .= '</div>';

  if(isset($bottom_image) && $bottom_image != ''){
    $html .= '
      <div class="text-center absolute-image '.$bottom_image_class.'" data-extend-top="'.$bottom_image_extend_top.'">
        <div class="container">
          <div class="centered-image">
            '. do_shortcode( '[image id="'.$bottom_image.'" size="'.$bottom_image_size.'"][/image]' ) . '
          </div>
        </div>
      </div>
    ';
  }



  //end section
  $html .= '</section>';

  return force_balance_tags($html);
}
add_shortcode('section','callback_section' );

function callback_row($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'contain' => ''
  ), $atts ));


  $html = '';

  //row
  $html .= '<div class="row '.$class.'">';

  $html .= do_shortcode( $content );

  //end row
  $html .= '</div>';

  if(isset($contain) && $contain == 'true')
    $html = '<div class="row"><div class="'.get_container_class().'">' . $html . '</div></div>';

  return force_balance_tags( $html );
}
add_shortcode('row','callback_row' );

function callback_column($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
  ), $atts ));

  //row
  $html = '<div class="'.$class.'" style="'.$style.'">';

  $html .= do_shortcode( $content );

  //end row
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode('column','callback_column' );





?>
