<?php

function callback_hr($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'center' => 'false',
    ), $atts ));

	$html = '';
    $html .= '<hr class="'.$class.'" style="'.$style.'"/>';

    return force_balance_tags( $html );
}
add_shortcode( 'hr' , 'callback_hr' );

?>
