<?php

function callback_spbl_features($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'images' => '',
		'text' => '',
		'row_size' => 3,
		'id' => ''
    ), $atts ));

    $html = '';

	$rowSize = intval($row_size);

	$images = explode(',', $images);
	$text = explode(',', $text);

	$imageRows = array_chunk($images, $rowSize);
	$textRows = array_chunk($text, $rowSize);

	$colClass = 'col-sm-' . floor(12 / $rowSize);

    $html = '<div class="spbl-features '.$class.'" style="'.$style.'">'; //spbl-features

	$html .= '<div class="spbl-features-bg spbl-features-bg1"></div>';
	$html .= '<div class="spbl-features-bg spbl-features-bg2"></div>';

	$outerCount = 0;

	$html .= '<div class="container">'; //container
	foreach ($imageRows as $imageRow) {
		$html .= '<div class="row">';

		$count = 0;

		foreach ($imageRow as $i) {
			$html .= '<div class="'.$colClass.'">';

			$html .= '<div class="spbl-feature">'; //spbl-feature

			$imgType = get_post_mime_type($i);

			$gif = '';

			if ($imgType === 'image/gif') {
				$gif = 'true';
			}

			$html .= '<div class="spbl-feature-image">';
			$html .= do_shortcode('[image id="'.$i.'" gif="'.$gif.'" size="spbp-experience" lightbox="false"][/image]');
			$html .= '</div>';

			$html .= '<span class="spbl-feature-text">' . $textRows[$outerCount][$count] . '</span>';

			$html .= '</div>'; //spbl-feature

			$html .= '</div>';

			$count++;
		}

		$html .= '</div>';

		$outerCount++;
	}

	$html .= '</div>'; //container

    $html .= '</div>'; //spbl-features

    return force_balance_tags( $html );
}
add_shortcode( 'spbl-features' , 'callback_spbl_features' );
