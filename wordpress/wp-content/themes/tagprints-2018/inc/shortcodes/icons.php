<?php

  function iconShortcode($id,$width,$height,$center = false){
    do_shortcode('[icon id="'.$id.'"]');
    $output = do_shortcode('[icon id="'.$id.'" width="'.$width.'" height="'.$height.'" center="'.$center.'"]');
    return $output;
  }

  function iconWidth($id){
    return get_post_meta($id,'default_width',true);
  }

  function iconHeight($id){
    return get_post_meta($id,'default_height',true);
  }

  function getIcon($id){
    $postIcon = get_post($id);
	if (!isset($postIcon) || !$postIcon) {
		return '';
	}
    $postContent = $postIcon->post_content;
    return $postContent;
  }

  function callback_tagprints_icon($attrs, $content = null){
    extract(shortcode_atts( array(
      'id' => '',
      'width' => null,
      'height' => null,
      'center' => null,
      'style' => null
    ), $attrs ));

	$html = '';
    $postIcon = get_post($id);
    $postContent = getIcon($id);
    $defaultHeight = iconHeight($id);
    $defaultWidth = iconWidth($id);

    $actualWidth = ($width) ? $width : $defaultWidth;
    $actualHeight = ($height) ? $height : $defaultHeight;

    $style .= " width: " . $actualWidth . "px; height: " . $actualHeight . "px; display:inline-block;";

    if($center){
      $style .= ' margin-left: auto; margin-right: auto; display: block;';
    }

    if($postContent){
      $html = "<span class='svg-icon' style='{$style}'>";
      $html .= $postContent; //icons($id);
      $html .= '</span>';
    }

    return force_balance_tags($html);
  }

  add_shortcode('icon','callback_tagprints_icon');

?>
