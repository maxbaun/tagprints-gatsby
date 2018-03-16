<?php

function callback_cta($atts,$content=null){
	extract(shortcode_atts( array(
		'class' => 'btn-cta',
		'style' => '',
		'text' => 'Get Pricing',
		'center' => 'true',
		'link' => '',
		'rel' => '',
		'target' => '',
		'modal' => null,
		'scroll_to' => null
	), $atts ));

	$html = '';
	if($center == 'true')
	$html .= '<div class="text-center btn-cta-wrapper">';

	$html .= '<a class="btn '.$class.'" style="'.$style.'" rel="'.$rel.'" target="'.$target.'"';
	if($modal){
		$html .= ' data-target="#'.$modal.'" data-toggle="modal" ';
	} else if ($scroll_to) {
		$html .= 'data-scroll="'.$scroll_to.'"';
	} else{
		$html .= ' href="'.$link.'" ';
	}

	$html .='">'.$text.'</a>';

	if($center == 'true')
	$html .= '</div>';

	return force_balance_tags($html );
}
add_shortcode('cta','callback_cta');

?>
