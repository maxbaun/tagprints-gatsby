<?php
function callback_map($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'marker_color' => ''

  ), $atts ));

  $html = '<style>';
  $html .= '.marker:hover{color:'.$marker_color.' !important;}';
  $html .= '</style>';
  $html .= '<div class="map">';
  $html .= '<img src="'.theme_image('map.png').'"/>';
  $html .= '</div>';

  return force_balance_tags( $html );
}
add_shortcode( 'map' , 'callback_map' );

function callback_google_map($atts,$content=null){
  extract(shortcode_atts( array(
    'class' => '',
    'style' => '',
    'id' => 'map-' . rand(0,100),
    'longitude' => '',
    'latitude' => '',
    'location' => 'Chicago',
    'address' => '320 West Ohio Stret, Chicago, IL 060654',
    'cta_text' => 'Get Directions',
    'cta_link' => '',
	'size' => 'half'

  ), $atts ));
  $html = '<div class="google-map-wrapper '.$size.'">';
  $html .= '
  <div
    id="map-'. $id.'"
    class="google-map '.$size.'"
    data-long="'.$longitude.'"
    data-lat="'.$latitude.'"
    data-marker="'.themeImage("marker.png").'"
    dara-market-retina="'.themeImage("marker@2x.png").'">';

  $html .= do_shortcode( $content );

  $html .= '</div>'; // google map
  $html .= '<div class="overlay">';

  $html .= '<div class="overlay-inner">';
  $html .= '<div class="vertical-center"><div class="vertical-center-inner">';
  $html .= '<img class="marker" src="'.themeImage("marker.png").'"/>';
  $html .= '<div class="location">' . $location . '</div>';
  $html .= '<div class="address">' . $address . '</div>';
  $html .= '<div class="break"></div>';
  $html .= do_shortcode('[cta text="'.$cta_text.'" link="'.$cta_link.'" class="btn-cta-transparent-white readmore" target="_blank"][/cta]');
  $html .= '</div></div>';
  $html .= '</div>';

  $html .= '</div>';
  $html .= '</div>';//google map wrapper

  return force_balance_tags($html);

}
add_shortcode( 'google-map' , 'callback_google_map' );

?>
