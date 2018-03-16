<?php
function callback_spbl_deliverables($atts, $content=null) {
	extract(shortcode_atts( array(
		'class' => '',
		'style' => '',
		'images' => '',
		'hover' => ''
    ), $atts ));

	$html = '';

	$images = explode(',', $images);
	$hover = explode('|', $hover);

	$html .= '<div class="spbl-deliverables '.$class.'" style="'.$style.'">'; //spbl-slider

	$html .= '<div class="row">'; //row

	$count = 0;

	foreach ($images as $image) {
		$extra = '';

		if ($count == 0) {
			$extra .= 'col-sm-offset-1';
		}
		$html .= '<div class="col-sm-2 '.$extra.'">';
		$html .= '<div class="spbl-deliverable">';
		if (!empty($hover[$count])) {
			$html .= '<span class="spbl-deliverable-hover">' . $hover[$count] . '</span>';
		}
		$html .= do_shortcode('[image id="'.$image.'" size="mini-small" center="true"][/image]');
		$html .= '</div>';
		$html .= '</div>';

		$count++;
	}

	$html .= '</div>'; //row

	$html .= '</div>'; // spbl-sharing

	return force_balance_tags( $html );
}

add_shortcode('spbl-deliverables', 'callback_spbl_deliverables');
