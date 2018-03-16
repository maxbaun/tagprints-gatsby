<?php

function callback_spbp_experiences($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'title' => '',
        'ids' => '',
        'images' => '',
        'text' => '',
        'image' => ''
    ), $atts ));

	global $_wp_additional_image_sizes;

	$imgSize = 'spbp-experience';
	$imgWidth = 0;

	foreach ($_wp_additional_image_sizes as $size => $dimensions) {
		if ($imgSize === $size) {
			$imgWidth = $dimensions['width'];
		}
	}

    $html = '';

    $html = '<div class="spbp-experiences '.$class.'" style="'.$style.'">'; //spbp-experiences

    $html .= '<div class="spbp-experiences-inner">'; //spbp-experiences-inner
    $html .= '<div class="container">'; //container
    $html .= '<h1 class="spbp-title">' . $title . '</h1>'; //spbp-experiences-title

    $html .= '<div class="spbp-experiences-grid">'; //spbp-experiences-grid

    $images = explode(',', $images);
    $text = explode(',', $text);
    $ids = explode(',', $ids);

    $imgGroups = array_chunk($images, 3);
    $txtGroups = array_chunk($text, 3);
    $idGroups = array_chunk($ids, 3);

    $count = 0;

    foreach ($imgGroups as $group) {
        $innerCount = 0;

        $html .= '<div class="spbp-experiences-row">'; //spbp-experiences-row

        foreach ($group as $image) {
            $html .= '<div class="spbp-experiences-item">';
            $html .= '<a class="spbp-experiences-item-link" data-scroll="#' . $idGroups[$count][$innerCount] . '">'; //a
            $html .= '<div class="spbp-experiences-overlay">';
            $html .= '<div class="spbp-experiences-overlay-inner">';
            $html .= '<span class="spbp-experiences-text">' . $txtGroups[$count][$innerCount] . '</span>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="spbp-experiences-image-wrap">';

			$imgType = get_post_mime_type($image);

			if ($imgType === 'image/gif') {
				$imgSize = 'full';

				$html .= '<div class="spbp-experiences-image-gif" style="width: '.$imgWidth.'px;">';
			}

            $html .= do_shortcode('[image id="'.$image.'" size="'.$imgSize.'"][/image]');

			if ($imgType === 'image/gif') {
				$html .= '</div>';
			}

            $html .= '</div>';

            $html .= '</a>'; //a
            $html .= '</div>';

            $innerCount += 1;
        }

        $html .= '</div>'; //spbp-experiences-row

        $count += 1;
    }

    $html .= '</div>'; //spbp-experiences-grid
    $html .= '</div>'; //container
    $html .= '</div>'; //spbp-experiences-inner

    $html .= '</div>'; //spbp-experiences

    return force_balance_tags( $html );
}
add_shortcode( 'spbp-experiences' , 'callback_spbp_experiences' );
