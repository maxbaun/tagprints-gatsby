<?php 
function callback_contact_text($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'text' => '',
    'font_size' => '',
    'show_icon' => 'false',
    'icon_class' => '',
    'link' => ''
  ), $atts ));

  $html = '';

  $style .= ' font-size:' . $font_size . 'px;';

  $html .= '<div class="contact-text-wrapper">';
  if(isset($show_icon) && $show_icon != 'false')
  	$html .= '<span class="contact-text-icon '.$icon_class.'" style="'.$style.'"></span>';
  $html .= '<span class="text" style="'.$style.'">';

  if(isset($link) && $link != '')
  	$html .= '<a href="'.$link.'">'.$text.'</a>';
  else
  	$html .= $text;
  $html .= '</span>';

  $html .= '</div>';

  return force_balance_tags( $html );  
}
add_shortcode( 'contact-text','callback_contact_text' );

?>