<?php

function callback_text_block($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'contain' => 'false'
  ), $atts ));  


  $html = '';
  if(isset($contain) && $contain =='true')
    $html .= '<div class="row"><div class="'.get_container_class().'">';

  $html .= '<div class="text-block '.$class.'" style="'.$style.'">'; //text
  $html .= do_shortcode($content);
  $html .= '</div>';

  if(isset($contain) && $contain =='true')
    $html .= '</div></div>';

  return force_balance_tags($html);
}

add_shortcode('text-block','callback_text_block' );

?>
