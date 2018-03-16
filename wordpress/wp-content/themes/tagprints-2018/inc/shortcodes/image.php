<?php

function callback_image_animate ( $id ) {
	$img = getImage( $id, 'full' );
	$frame_size = get_field( 'frame_size', $id );
	$frame_count = get_field( 'frame_count', $id );

	return \Timber\Timber::compile( 'includes/image-animate.twig', array(
		'image' => array(
			'src' => $img['src'],
			'srcset' => $img['srcset'],
			'height' => $img['height'],
			'width' => $img['width'],
			'frame_size' => $frame_size,
			'frame_count' => $frame_count,
		),
	) );
}

function callback_image($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'id' => '',
        'size' => 'large',
        'center' => 'false',
        'valign' => 'false',
        'lightbox' => 'false',
        'lightbox_group' => '',
        'infographic' => 'false',
        'retina' => 'false',
        'shadow' => 'false',
        'gif' => 'false'
    ), $atts ));

    if ($gif == 'true') {
        $size = 'full';
    }

	if ( get_field( 'animate_image', $id ) ) {
		return callback_image_animate( $id );
	}

    $img = '';
    if(isset($infographic) && $infographic == 'true')
    $img = getImage($id,'750');
    else
    $img = getImage($id,$size);

    if(isset($center) && $center == 'true'){
        $style .= ' margin-right:auto;margin-left:auto;display:block;';
    }

    if(isset($valign) && $valign == 'true'){
        $style .= 'position:absolute;margin-top:-'. ((int)$img['height'] / 2) .'px;top:50%;';
    }

    $html = '';

    if(isset($lightbox_group) && $lightbox_group != '' && $infographic == 'false'){
        $fullImage = getImage($id,'full');
        $html .= '<a data-lightbox="'.$lightbox_group.'" href="'.$fullImage['src'].'">';
    }
    else if(isset($infographic) && $infographic == 'true'){
        $attachmentUrl = get_attachment_link($id);
        $html .= '<a href="'.$attachmentUrl.'">';
    }

    // if(isset($retina) && $retina === 'true'){
    //   $html .= retinaImageStyle($id,$size);
    //   $html .= '<div id="bgimage-'.$id.'" data-width="'.$img['width'].'" data-height="'.$img['height'].'" style="'.$style.'"/>';
    // } else{
    //
    // }

    $sizes = wp_calculate_image_sizes($size);
    if ($gif == 'true') {
        $html .= '<img src="'.$img['src'].'" height="'.$img['height'].'" width="'.$img['width'].'" data-width="'.$img['width'].'" data-height="'.$img['height'].'" style="'.$style.'"/>';
    } else {
        $html .= '<img src="'.$img['src'].'" sizes="(max-width: '.$img['width'].'px) 100vw, '.$img['width'].'px" srcset="'.$img['srcset'].'" height="'.$img['height'].'" width="'.$img['width'].'" data-width="'.$img['width'].'" data-height="'.$img['height'].'" style="'.$style.'"/>';
    }

    if((isset($lightbox_group) && $lightbox_group != '') || (isset($infographic) && $infographic == 'true'))
    $html .= '</a>';

    if(!empty($shadow) && $shadow == 'true'){
        $shadow_style = '';
        if(isset($center) && $center == 'true'){
            $shadow_style .= ' margin-right:auto;margin-left:auto;display:block;';
        }

        $html .= '<div class="image-shadow" style="'.$shadow_style.'"></div>';
    }

    return force_balance_tags( $html );
}
add_shortcode( 'image','callback_image' );

function imageShortcode($id,$size){
    return do_shortcode('[image id="'.$id.'" size="'.$size.'"]');
}

function callback_image_row($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'count' => ''
    ), $atts ));

    $html = '<div class="image-row count-' . $count . ' ' . $class . '">';

    $html .= do_shortcode($content);

    $html .= '</div>';

    return force_balance_tags( $html );
}
add_shortcode( 'image-row','callback_image_row' );

function getImage($id,$size){
    $imgData = wp_get_attachment_image_src( $id,$size);
    $imgSrc = $imgData[0];
    $imgWidth = $imgData[1];
    $imgHeight = $imgData[2];
    $imgSrcSet = wp_get_attachment_image_srcset($id,$size);

    return array('src'=>$imgSrc,'width'=>$imgWidth,'height'=>$imgHeight,'srcset'=>$imgSrcSet);
}

function backgroundImage($id,$size){
    $imgData = getImage($id,$size);
    $bgImage = 'background-image:url('.$imgData['src'].');background-size: '.$imgData['width'].'px '.$imgData['height'].'px;';
    return $bgImage;
}

function iconBackgroundImage($id,$size){
    $imgData = getImage($id,$size);
    $bgImage = 'background-image:url('.$imgData['src'].'); background-repeat: no-repeat; background-size: '.$imgData['width'].'px '.$imgData['height'].'px; height: '.$imgData['height'].'px; width: '.$imgData['width'].'px;';
    return $bgImage;
}

function url_exists($url) {
    $file = $url;
    $file_headers = @get_headers($file);
    if(!strpos($file_headers[0], '200')) {
        $exists = false;
    }
    else {
        $exists = true;
    }

    return $exists;
}

function backgroundImageStyle($id,$size, $cover = false, $mobile_image = array()){

    if(!isset($id) || $id == '')
    return '';

    $imgData = getImage($id,$size);

    $ext = pathinfo($imgData['src'], PATHINFO_EXTENSION);

    $retinaFile = str_replace('.'.$ext, '@2x.' . $ext, $imgData['src']);

    if(!url_exists($retinaFile))
    $retinaFile = $imgData['src'];

    $id = 'bgimage-' . $id;
    $style = '<style type="text/css">#'.$id.'{
        background-image: url("'.$imgData['src'].'"); ';
        if(!$cover) {
            $style .= 'background-size: '.$imgData['width'].'px ' . $imgData['height'] . 'px;';
        }

        $style .= '
    }
    @media (min--moz-device-pixel-ratio: 1.3),
    (-o-min-device-pixel-ratio: 2.6/2),
    (-webkit-min-device-pixel-ratio: 1.3),
    (min-device-pixel-ratio: 1.3),
    (min-resolution: 1.3dppx) {
        #'.$id.'{
            background-image: url("'.$retinaFile.'"); ';

            if(!$cover) {
                $style .= 'background-size: '.$imgData['width'].'px ' . $imgData['height'] . 'px;';
            }

            $style .= '
        }}';

        if (!empty($mobile_image['id'])) {
            $screenSizes = getScreenSizes();
            $mobileBreakPoint = $screenSizes['sm'];

            $mobile_image['size'] = (!empty($mobile_image['size'])) ? $mobile_image['size'] : 'full';

            $mobileImgData = getImage($mobile_image['id'],$mobile_image['size']);

            $ext = pathinfo($mobileImgData['src'], PATHINFO_EXTENSION);

            $retinaFile = str_replace('.'.$ext, '@2x.' . $ext, $mobileImgData['src']);

            if(!url_exists($retinaFile))
            $retinaFile = $mobileImgData['src'];

            $style .= '
            @media (max-width:'.$mobileBreakPoint.'){
                #'.$id.' {
                    background-image: url("'.$mobileImgData['src'].'"); ';
                    if(!$cover) {
                        $style .= 'background-size: '.$mobileImgData['width'].'px ' . $mobileImgData['height'] . 'px;';
                        $style .= 'height: ' . $mobileImgData['height'] . 'px !important;';
                    }
                    $style .= '}';


                    $style .= '
                    @media (min--moz-device-pixel-ratio: 1.3) and (max-width:'.$mobileBreakPoint.'),
                    (-o-min-device-pixel-ratio: 2.6/2) and (max-width:'.$mobileBreakPoint.'),
                    (-webkit-min-device-pixel-ratio: 1.3) and (max-width:'.$mobileBreakPoint.'),
                    (min-device-pixel-ratio: 1.3) and (max-width:'.$mobileBreakPoint.'),
                    (min-resolution: 1.3dppx) and (max-width:'.$mobileBreakPoint.') {
                        #'.$id.'{
                            background-image: url("'.$retinaFile.'"); ';

                            if(!$cover) {
                                $style .= 'background-size: '.$mobileImgData['width'].'px ' . $mobileImgData['height'] . 'px;';
                            }

                            $style .= '
                        }
                    }}';
                }


                $style .= '</style>';
                return $style;

            }

            function retinaImageStyle($id,$size){

                if(!isset($id) || $id == '')
                return '';

                $imgData = getImage($id,$size);

                $ext = pathinfo($imgData['src'], PATHINFO_EXTENSION);

                $retinaFile = str_replace('.'.$ext, '@2x.' . $ext, $imgData['src']);
                if(!url_exists($retinaFile))
                $retinaFile = $imgData['src'];

                $id = 'bgimage-' . $id;
                $style = '<style type="text/css">#'.$id.'{
                    background-image: url("'.$imgData['src'].'");
                    background-size: '.$imgData['width'].'px ' . $imgData['height'] . 'px;
                    height: '.$imgData['height'].'px;
                    width: '.$imgData['width'].'px;
                    background-repeat: no-repeat;
                }
                @media (min--moz-device-pixel-ratio: 1.3),
                (-o-min-device-pixel-ratio: 2.6/2),
                (-webkit-min-device-pixel-ratio: 1.3),
                (min-device-pixel-ratio: 1.3),
                (min-resolution: 1.3dppx) {
                    #'.$id.'{
                        background-image: url("'.$retinaFile.'");
                        background-size: '.$imgData['width'].'px ' . $imgData['height'] . 'px;
                        height: '.$imgData['height'].'px;
                        width: '.$imgData['width'].'px;
                    }
                }
                </style>';
                return $style;

            }

            function themeImage($filename){
                return get_template_directory_uri() . '/dist/images/' . $filename;
            }

            ?>
