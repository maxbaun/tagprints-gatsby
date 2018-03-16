<?php
function callback_blog_categories($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'title' => ''
  ), $atts ));  

  $html = '<div class="blog-categories">'; // blog categories

  $terms = get_blog_categories();

  $html .= '<ul class="categories">';
  foreach($terms as $term){
  	$html .= '<li class="term"><a href="'.get_term_link($term).'">' . $term->name . '</a></li>';
  }
  $html .= '</ul>';

  $html .= '</div>';


  return force_balance_tags($html);
}

add_shortcode('blog-categories','callback_blog_categories' );

?>