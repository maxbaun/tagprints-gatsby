<?php
/**
* Clean up the_excerpt()
*/
function cutlass_excerpt_more($more) {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'cutlass') . '</a>';
}
add_filter('excerpt_more', 'cutlass_excerpt_more');

/**
* Manage output of wp_title()
*/
function cutlass_wp_title($title) {
    if (is_feed()) {
        return $title;
    }

    $title .= get_bloginfo('name');

    return $title;
}
add_filter('wp_title', 'cutlass_wp_title', 10);

/**
* Manage output of wp_title()
*/
function theme_image($img){
    //var_dump($img);
    $path = get_template_directory_uri() . '/dist/img/' . $img;
    return $path;
}

function getImageBackgroundStyle($id,$post = true,$offset=0, $setHeight = true){
    if($post) {
		$imageId = get_post_thumbnail_id($id);
	}
    else {
		$imageId = $id;
	}
    $image = wp_get_attachment_image_src($imageId,'full');

	if (!isset($image) || !$image) {
		return '';
	}

    $imageUrl = $image[0];
    $imageWidth = $image[1];
    $imageHeight = $image[2];

    $h = $imageHeight + $offset;

    if($setHeight){
        $style = 'background-image:url('.$imageUrl.'); height: '.$h.'px;background-size:' . $imageWidth . 'px ' . $imageHeight .'px;';
    } else {
        $style = 'background-image:url('.$imageUrl.'); background-size: cover; ';
    }
    return $style;
}

function brandColor(){
    global $post;
    $brandColor = get_post_meta($post->ID,'cs_brand_color',true);
    return $brandColor;
}

// WPAUTOP
remove_filter('the_content','wpautop');
add_filter('the_content','my_custom_formatting');

function my_custom_formatting($content){
    if(get_post_type()!='post')
    return $content; //no autop
    else
    return wpautop($content);
}
// END WPAUTOP

function get_container_class(){
    return 'col-md-8 col-md-offset-2';
}

add_filter('gform_submit_button','callback_gform_submit_btn',10,2);
function callback_gform_submit_btn($button, $form){
    $html = '<button type="submit" class="btn btn-cta btn-cta-transparent-inverse" value="'.$form['button']['text'].'" id="gform_submit_button_' . $form['id'].'">' . $form['button']['text'] . '</button>';
    return $html;
}


// add_filter( 'gform_confirmation', 'callback_confirmation', 10, 4 );
// function callback_confirmation($confirmation, $form, $entry, $ajax){
//   var_dump($form);
//   return 'asdfasd';
//   // return force_balance_tags($confirmation);
// }

add_filter( 'gform_validation_1', 'callback_gform_validation' );
function callback_gform_validation( $validation_result ) {
    $form = $validation_result['form'];

    if ( rgpost( 'input_5' ) != 9 ) {

        // set the form validation to false
        $validation_result['is_valid'] = false;

        //finding Field with ID of 1 and marking it as failed validation
        foreach( $form['fields'] as &$field ) {

            //NOTE: replace 1 with the field you would like to validate
            if ( $field->id == '5' ) {
                $field->failed_validation = true;
                $field->validation_message = 'This field is invalid!';
                break;
            }
        }

    }

    //Assign modified $form object back to the validation result
    $validation_result['form'] = $form;
    return $validation_result;

}

function get_related_posts(){
    global $post;
    //for use in the loop, list 5 post titles related to first tag on current post
    $categories = wp_get_post_categories($post->ID);
    $related_posts = array();
    if ($categories) {
        $args=array(
            'category__in' => $categories,
            'post__not_in' => array($post->ID),
            'posts_per_page'=>3,
        );
        $my_query = new WP_Query($args);
        if( $my_query->have_posts() ) {
            while ($my_query->have_posts()){
                $my_query->the_post();
                $related_posts[] = $post;
            }
        }
        wp_reset_query();
    }
    return $related_posts;

}

function get_blog_categories(){
    $taxonomies = array('category');

    $args = array(

    );

    $terms = get_terms($taxonomies,$args);
    return $terms;

}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
    global $post;
    return '...';
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_action( 'add_meta_boxes', 'posts_meta_box' );
function posts_meta_box()
{
    add_meta_box( 'post-properties', 'Post Properties', 'cb_post_properties', 'post', 'normal', 'high' );
}

function cb_post_properties( $post )
{
    $values = get_post_custom( $post->ID );
    $showFeaturedImage = $values['show-featured-image'][0];

    ?>
    <p>
        <label for="show-featured-image">Show Featured Image: </label>
        <input type="checkbox" name="show-featured-image" id="show-featured-image" <?php if( $showFeaturedImage == true ) { ?>checked="checked"<?php } ?> />
    </p>

    <?php
}


add_action( 'save_post', 'save_post_properties' );
function save_post_properties( $post_id )
{
    // Probably a good idea to make sure your data is set
    if( isset( $_POST['show-featured-image'] ) )
    update_post_meta( $post_id, 'show-featured-image', true);
    else
    update_post_meta( $post_id, 'show-featured-image', false);
}

function lessThenIe9(){
    $ret = false;
    if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(?i)msie [5-8]/',$_SERVER['HTTP_USER_AGENT'])){
        $ret = true;
    }

    return $ret;
}

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter( 'gform_confirmation_anchor', '__return_true' );



function _remove_query_strings_1( $src ){
    $rqs = explode( '?ver', $src );
    return $rqs[0];
}
if ( !is_admin() ) {
    add_filter( 'script_loader_src', '_remove_query_strings_1', 15, 1 );
    add_filter( 'style_loader_src', '_remove_query_strings_1', 15, 1 );
}


function _remove_query_strings_2( $src ){
    $rqs = explode( '&ver', $src );
    return $rqs[0];
}
if ( !is_admin() ) {
    add_filter( 'script_loader_src', '_remove_query_strings_2', 15, 1 );
    add_filter( 'style_loader_src', '_remove_query_strings_2', 15, 1 );
}

function getScreenSizes () {
    return array(
        'xs' => '320px',
        'sm' => '480px',
        'md' => '768px',
        'lg' => '992px',
        'xl' => '1200px'
    );
}

add_filter('image_send_to_editor', 'tpImageSendToEditor', 1, 2);
function tpImageSendToEditor($html, $id)
{
    $dom = new DOMDocument();
    @$dom->loadHTML($html);

    $x = new DOMXPath($dom);
    foreach($x->query("//img") as $node){
       $node->setAttribute("data-id", $id);
    }

    if ($dom->getElementsByTagName("a")->length == 0) {
        $newHtml = $dom->saveXML($dom->getElementsByTagName('img')->item(0));
    } else {
        $newHtml = $dom->saveXML($dom->getElementsByTagName('a')->item(0));
    }

    return $newHtml;
}
