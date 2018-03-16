<?php

// function callback_team_member($atts,$content=null){
//   extract(shortcode_atts( array(
//     'class' => '',
//     'style' => '',
//     'facebook' => '',
//     'twitter' => '',
//     'linkedin' => '',
//     'name' => 'false',
//     'title' => '',
//     'fact' => '',
//     'image' => ''
//   ), $atts ));
//
//   $html = '';
//   $bgImageStyle = backgroundImageStyle($image,'small');
//   $html .= $bgImageStyle;
//   $html .= '<div class="team-member">';
//
//
//
//   $html .= '<div id="bgimage-'.$image.'" class="header hover">';
//  //  $html .= '<div class="overlay">';
//  //  $html .= '<div class="fact">' . $fact . '</div>';
//  //  $html .= '<div class="social">';
//  //  if(isset($facebook) && $facebook != '')
//  //  	$html .= '<a href="'.$facebook.'" target="_blank"><span class="fa fa-facebook"></span></a>';
// 	// if(isset($twitter) && $twitter != '')
//  //  	$html .= '<a href="'.$twitter.'" target="_blank"><span class="fa fa-twitter"></span></a>';
// 	// if(isset($linkedin) && $linkedin != '')
//  //  	$html .= '<a href="'.$linkedin.'" target="_blank"><span class="fa fa-linkedin"></span></a>';
//  //  $html .= '</div>'; //social
//  //  $html .= '</div>'; // overlay
//   $html .= '</div>'; //header
//
//   $html .= '<div class="content">';
//   $html .= '<span class="name">' . $name . '</span>';
//   $html .= '<span class="title">' . $title . '</span>';
//   $html .= '</div>';
//
//   $html .= '</div>'; //team-member
//
//   return force_balance_tags( $html );
// }
// add_shortcode( 'team-member','callback_team_member' );

function callback_team_member($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'name' => '',
        'title' => '',
        'image' => '',
        'image_active' => ''
    ), $atts ));

    $html = '';
    $imgData = getImage($image,'team-member');
    $imgActiveData = getImage($image_active,'full');

    $html .= '<div class="team-member col-sm-4">';

    $html .= '<div class="team-member-image-container" style="width:'.$imgData['width'].'px;height:'.$imgData['height'].'px;">';
    $html .= '<img class="image-normal" src="'.$imgData['src'].'"/>'; //regular image
    $html .= '<img class="image-gif" src="'.$imgActiveData['src'].'" width="'.$imgData['width'].'" height="'.$imgData['height'].'"/>'; //active image
    $html .= '</div>';

    $html .= '<div class="content text-center">'; //content
    $html .= '<span class="team-member-name">' . $name . '</span>';
    $html .= '<span class="team-member-title">' . $title . '</span>';
    $html .= '</div>'; //content

    $html .= '</div>'; //team-member

    return force_balance_tags( $html );
}
add_shortcode( 'team-member','callback_team_member' );

function callback_team_members($atts,$content=null){
    extract(shortcode_atts( array(
        'class' => '',
        'style' => '',
        'id' => ''
    ), $atts ));

    $html = '';
    $html .= '<div id="'.$id.'" class="team-members row">'; //team members
    $html .= do_shortcode($content);
    $html .= '</div>'; //team-members

    return force_balance_tags( $html );
}
add_shortcode( 'team-members','callback_team_members' );
?>
