<?php

function deregister_scripts() {

  if(is_page_template('template-landing.php')){
    wp_deregister_script('photonic-slideshow');
    wp_deregister_script('jquery-cycle');
    wp_deregister_script('photonic');

    wp_deregister_style('photonic-slideshow');
    wp_deregister_style('photonic');

    wp_deregister_script('picturefill');
  }


}
add_action('wp_enqueue_scripts', 'deregister_scripts', 99);


?>
