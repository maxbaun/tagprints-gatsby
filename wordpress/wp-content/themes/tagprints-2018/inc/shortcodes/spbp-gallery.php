<?php

function callback_spbp_gallery($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'id' => '',
        'title' => '',
        'images' => '',
        'row_size' => 3,
		'visible' => 3,
		'lightbox' => 'true'
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

    $rowSize = intval($row_size);
    $images = explode(',', $images);
    $featured = array_slice($images, 0, $visible);
    $hidden = array_slice($images, $visible, count($images) - $visible);
    $toggleId = $id . '-hidden';

    $html = '<div id="' . $id . '" class="spbp-gallery '.$class.'" style="'.$style.'">'; //spbp-gallery

    $html .= '<div class="spbp-gallery-inner">'; //spbp-gallery-inner

    $html .= '<div class="container">'; //container

    $html .= '<h1 class="spbp-title text-center">' . $title . '</h1>'; //spbp-title

    $html .= '<div class="spbp-gallery-images">'; // spbp-gallery-images

    $html .= '<div class="row">'; //row
    foreach ($featured as $f) {
        $html .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">'; //col
        $html .= '<div class="spbp-gallery-image">';

		$imgType = get_post_mime_type($f);

		if ($imgType === 'image/gif') {
			$imgSize = 'full';

			$html .= '<div style="max-width: 100%; width: '.$imgWidth.'px; height: auto;">';
		}

		if ($lightbox == 'true') {
			$html .= do_shortcode('[image id="'.$f.'" size="'.$imgSize.'" lightbox="true" lightbox_group="'.$id.'"][/image]');
		} else {
			$html .= do_shortcode('[image id="'.$f.'" size="'.$imgSize.'" lightbox="false"][/image]');
		}

		if ($imgType === 'image/gif') {
			$html .= '</div>';
		}

        $html .='</div>';
        $html .='</div>'; //col
    }
    $html .= '</div>'; //row

    $html .= '<div id="'.$toggleId.'" class="spbp-gallery-images-hidden" style="display: none;">'; //spbp-gallery-images-hidden

	if (count($hidden) > 0) {
		$hiddenRow = array_chunk($hidden, $rowSize);

		foreach ($hiddenRow as $row) {
			$html .= '<div class="row">'; //row
			foreach ($row as $image) {
				$html .= '<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">'; //col
				$html .= '<div class="spbp-gallery-image">';
				$html .= do_shortcode('[image id="'.$image.'" size="spbp-experience" lightbox="true" lightbox_group="'.$id.'"][/image]');
				$html .='</div>';
				$html .='</div>'; //col
			}
			$html .= '</div>'; //row
		}

		$html .= '</div>'; //spbp-gallery-images-hidden

		$html .= '<div class="spbp-gallery-toggle-wrap">'; //spbp-gallery-toggle-wrap
		$html .= '<a class="spbp-gallery-toggle" data-toggle="#'.$toggleId.'" data-more="View More" data-less="Show Less">';
		$html .= '<span class="spbp-gallery-toggle-icon-up"></span>';
		$html .= '<span class="spbp-gallery-toggle-text">View More</span>';
		$html .= '<span class="spbp-gallery-toggle-icon-down"></span>';
		$html .= '</a>';
		$html .= '</div>'; //spbp-gallery-toggle-wrap
	}

    $html .= '</div>'; //spbp-gallery-images

    $html .= '</div>'; //container

    $html .= '</div>'; //spbp-gallery-inner

    $html .= '</div>'; //spbp-gallery

    return force_balance_tags( $html );
}
add_shortcode( 'spbp-gallery' , 'callback_spbp_gallery' );
