<?php

function callback_landing_page_navbar($atts,$content=null){
	extract(shortcode_atts( array(
		'address' => 'false',
		'class' => '',
		'logo' => '',
		'logo_link' => ''
	), $atts ));

	$html = '<div class="landing-page-navbar '.$class.'">';
	$socialHtml = '';

	$contentHtml = '';
	if(isset($content) && $content != ''){
		// $contentHtml .= '<div class="navbar-nav navbar-center">';
		$contentHtml .= '<ul class="landing-page-navbar-content text-center">';
		$contentHtml .= do_shortcode($content);
		$contentHtml .= '</ul>';
		// $contentHtml .= '</div>';
	}

	if(isset($logo) && $logo != ''){
		$logoStyle = retinaImageStyle($logo,'logo');
		$html .= $logoStyle;
	}

	$logo_link_html = '';
	if(isset($logo_link) && $logo_link != ''){
		$logo_link_html = 'href="'. $logo_link .'"';
	}

	$html .=
	'<header>
	<div class="banner navbar navbar-landing" role="banner">
	<div class="container">
	<div class="navbar-header">
	<a class="navbar-brand" '.$logo_link_html.'><div id="bgimage-'.$logo.'"></div></a>
	</div>
	<div class="navbar-social">
	'.$socialHtml.'
	</div>
	<div class="clearfix"></div>
	'.$contentHtml.'
	</div>
	</div>
	</header>';

	$html .= '</div>';

	return force_balance_tags($html);
}

add_shortcode('landing-page-navbar','callback_landing_page_navbar' );

function callback_landing_page_navbar_item($atts,$content=null){
	extract(shortcode_atts( array(
		'text' => '',
	), $atts ));


	$html = '<li class="landing-page-navbar-item">';
	$html .= $text;
	$html .= '</li>';

	return force_balance_tags($html);
}

add_shortcode('landing-page-navbar-item','callback_landing_page_navbar_item' );

?>
