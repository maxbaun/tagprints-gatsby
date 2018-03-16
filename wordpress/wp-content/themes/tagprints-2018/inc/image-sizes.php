<?php

add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
  $addsizes = array(
    "logo" => __( "Logo Size")
  );
  $newsizes = array_merge($sizes, $addsizes);
  return $newsizes;
}

add_image_size('mini',95,9999,false);
add_image_size('mini-small',144,9999,false);
add_image_size('small',150,9999,false);
add_image_size('logo',160,31.5,false);
add_image_size('nav-logo', 164, 32, true);
add_image_size('medium-thumb',250,9999,false);
add_image_size('small-medium',550,9999,false);
add_image_size('case-study-large',742,9999,false);
add_image_size('case-study-medium',600,9999,false);
add_image_size('service-header', 600,656, false);
add_image_size('featured-home', 378.5,150, false);
add_image_size('hero', 1600,9999, false);
add_image_size('carousel', 9999,720, false);
add_image_size('blog-featured', 716,259, false);
add_image_size('slider-logo', 213,34, false);
add_image_size('landing-photobooth', 235, 300, false);
add_image_size('spbp-photobooth', 265, 355, false);
add_image_size('spbp-experience', 378, 254, true);
add_image_size('content-block-horizontal', 250, 170, false);
add_image_size('content-block-vertical', 9999, 240, false);
add_image_size('content-block-hashtag', 340, 226, false);
add_image_size('landing-page-map-icon', 50, 9999, false);
add_image_size('landing-quote-thumbnail', 75, 75, true);
add_image_size('team-member', 9999, 220, false);
add_image_size('carousel-mobile', 480, 9999999, false);
add_image_size( 'array13-banner', 900, 752, false );
add_image_size( 'array13-gallery-thumb', 350, 350, true );
add_image_size('our-work-preview', 450, 450, false);
// add_image_size('post-thumbnail',275,209,true);
// add_image_size('logos-one-line', 589,62.5, false);
// add_image_size('featured-case-study-image', 476,310, false);
// add_image_size('case-study-small',200,9999,false);
// add_image_size('featured-case-study-bg', 555,368, false);
// add_image_size('quote-block-logo', 95,60, false);
// add_image_size('title-image', 138,114, false);
// add_image_size('featured-case-study-logo', 144,50, false);
// add_image_size('service-step', 150,150, false);
// add_image_size('bio-image', 152,169, false);
// add_image_size('featured-case-study-logo-large', 160,105, false);
// add_image_size('quote-block-image', 180,180, false);
// add_image_size('benefit-thumbnail',250,250,true);
// add_image_size('quote-block-image-large', 272,271, false);
// add_image_size('post-thumbnail',275,209,true);
// add_image_size('home-slider', 1600,400, false);
// add_image_size('logos-small', 787,251, false);
// add_image_size('logos', 1024,330, false);
// add_image_size('case-study-xl', 742,831, false);
// add_image_size('case-study-large', 742,543, false);
// add_image_size('case-study-medium', 640,426.5, false);
// add_image_size('case-study-tall', 600,900, false);
// add_image_size('case-study-tall-thumb', 200,300, false);
// add_image_size('case-study-short', 742,231, false);

?>
