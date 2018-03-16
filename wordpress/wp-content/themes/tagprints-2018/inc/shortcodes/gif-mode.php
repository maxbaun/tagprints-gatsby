<?php

function callback_gif_mode($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'target' => '',
        'center' => 'false'
    ), $atts ));

    global $GIF_FRAME_TOTAL;
    global $GIF_FRAME_COUNT;

    $GIF_FRAME_COUNT = 0;
    $GIF_FRAME_TOTAL = (empty($count)) ? 1 : intval($count);

    $html = '';

    if($center == 'true') {
        $style .= 'margin-right: auto; margin-left: auto;';
    }

    $html .= '<a class="gif-mode '.$class.'" style="'.$style.'" data-target="'.$target.'"></a>';
    $html .= '<a class="gif-mode active '.$class.'" style="'.$style.'" data-target="'.$target.'"></a>';

    return force_balance_tags( $html );
}
add_shortcode('gif-mode','callback_gif_mode' );

?>
