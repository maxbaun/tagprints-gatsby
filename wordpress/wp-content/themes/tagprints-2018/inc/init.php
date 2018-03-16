<?php
/**
* Cutlass initial setup and constants
*/
function cutlass_setup() {
    // Make theme available for translation
    // Community translations can be found at https://github.com/cutlass/cutlass-translations
    load_theme_textdomain('cutlass', get_template_directory() . '/lang');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus
    register_nav_menus(array(
        'primary_navigation' => __('Primary Navigation', 'cutlass'),
        'footer_navigation'  => __('Footer Navigation','cutlass')
    ));

    // Add post thumbnails
    // http://codex.wordpress.org/Post_Thumbnails
    // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    // http://codex.wordpress.org/Function_Reference/add_image_size
    add_theme_support('post-thumbnails');

    // Add post formats
    // http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

    // Add HTML5 markup for captions
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', array('caption'));

    // Tell the TinyMCE editor to use a custom stylesheet
    add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'cutlass_setup');

/**
* Register sidebars
*/
function cutlass_widgets_init() {

    register_sidebar(array(
        'name'          => __('Footer', 'cutlass'),
        'id'            => 'sidebar-footer',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'cutlass_widgets_init');


/**
* Theme assets
*/
function assets() {

    // wp_dequeue_script('jquery');
    // wp_deregister_script('jquery');

    // wp_dequeue_script('jquery-migrate');
    // wp_deregister_script('jquery-migrate');
    // wp_register_script('jquery', asset_path('scripts/jquery.js'), false, false, true);
    // wp_enqueue_script('jquery');
    //
    // wp_register_script('vendor/js', asset_path('scripts/vendor.js'), ['jquery'], null, true);
    // wp_enqueue_script('vendor/js');

    // wp_enqueue_style('vendor/css', asset_path('styles/vendor.css'), false, null);
    // wp_enqueue_style('bootstrap/css', asset_path('styles/bootstrap.css'), false, null);
    wp_enqueue_style('tagprints/css', asset_path('styles/main.css'), false, null);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if(is_page_template('template-contact.php')){
        wp_register_script('google-maps','https://maps.googleapis.com/maps/api/js?key=AIzaSyAZyFJjtN1lLLz3UoVF_mDelyTQOSZ0-rY',array(),false,true);
        wp_enqueue_script('google-maps');
    }

    // wp_register_script('vendor-2','https://cdn.ywxi.net/js/1.js',array('jquery'),null,true);
    // wp_enqueue_script('vendor-2');

    wp_enqueue_script('tagprints/js', asset_path('scripts/main.js'), ['jquery'], null, true);

    pluginScripts();

}
add_action('wp_enqueue_scripts', 'assets', 100);



function pluginScripts(){
    googleTagPlugin();
    gravityFormsPlugin();
}

function googleTagPlugin(){
    wp_deregister_script("gtm4wp-outbound-click-tracker");
    wp_deregister_script("gtm4wp-download-tracker");
    wp_deregister_script("gtm4wp-email-link-tracker");
    wp_deregister_script("gtm4wp-contact-form-7-tracker");
    wp_deregister_script("gtm4wp-form-move-tracker");
    wp_deregister_script("gtm4wp-social-actions");
    wp_deregister_script("gtm4wp-scroll-tracking");

    global $gtm4wp_options, $gtp4wp_plugin_url;

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_EVENTS_OUTBOUND' ] ) {
        wp_enqueue_script( "gtm4wp-outbound-click-tracker", $gtp4wp_plugin_url . "js/gtm4wp-outbound-click-tracker.js", array( "jquery" ), "1.0", true );
    }

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_EVENTS_DOWNLOADS' ] ) {
        wp_enqueue_script( "gtm4wp-download-tracker", $gtp4wp_plugin_url . "js/gtm4wp-download-tracker.js", array( "jquery" ), "1.0", true );
    }

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_EVENTS_EMAILCLICKS' ] ) {
        wp_enqueue_script( "gtm4wp-email-link-tracker", $gtp4wp_plugin_url . "js/gtm4wp-email-link-tracker.js", array( "jquery" ), "1.0", true );
    }

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_INTEGRATE_WPCF7' ] ) {
        wp_enqueue_script( "gtm4wp-contact-form-7-tracker", $gtp4wp_plugin_url . "js/gtm4wp-contact-form-7-tracker.js", array( "jquery" ), "1.0", true );
    }

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_EVENTS_FORMMOVE' ] ) {
        wp_enqueue_script( "gtm4wp-form-move-tracker", $gtp4wp_plugin_url . "js/gtm4wp-form-move-tracker.js", array( "jquery" ), "1.0", true );
    }

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_EVENTS_SOCIAL' ] ) {
        wp_enqueue_script( "gtm4wp-social-actions", $gtp4wp_plugin_url . "js/gtm4wp-social-tracker.js", array( "jquery" ), "1.0", true );
    }

    if ( $gtm4wp_options[ 'GTM4WP_OPTION_SCROLLER_ENABLED' ] ) {
        wp_enqueue_script( "gtm4wp-scroll-tracking", $gtp4wp_plugin_url . "js/analytics-talk-content-tracking.js", array( "jquery" ), "1.0", true );
    }
}

function gravityFormsPlugin(){
    $base_url = GFCommon::get_base_url();
    $version  = GFForms::$version;

    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';

    wp_register_script( 'gform_chosen', $base_url . '/js/chosen.jquery.min.js', array( 'jquery' ), $version ,true);
    wp_register_script( 'gform_conditional_logic', $base_url . "/js/conditional_logic{$min}.js", array( 'jquery', 'gform_gravityforms' ), $version ,true);
    wp_register_script( 'gform_datepicker_init', $base_url . "/js/datepicker{$min}.js", array( 'jquery', 'jquery-ui-datepicker', 'gform_gravityforms' ), $version, true );
    wp_register_script( 'gform_floatmenu', $base_url . "/js/floatmenu_init{$min}.js", array( 'jquery' ), $version , true);
    wp_register_script( 'gform_form_admin', $base_url . "/js/form_admin{$min}.js", array( 'jquery', 'jquery-ui-autocomplete', 'gform_placeholder' ), $version , true);
    wp_register_script( 'gform_form_editor', $base_url . "/js/form_editor{$min}.js", array( 'jquery', 'gform_json', 'gform_placeholder' ), $version ,true);
    wp_register_script( 'gform_forms', $base_url . "/js/forms{$min}.js", array( 'jquery' ), $version , true);
    wp_register_script( 'gform_gravityforms', $base_url . "/js/gravityforms{$min}.js", array( 'jquery', 'gform_json' ), $version , true);
    wp_deregister_script( 'gform_json');
    wp_register_script( 'gform_json', $base_url . "/js/jquery.json.js" , array( 'jquery' ), $version , true);
    wp_register_script( 'gform_masked_input', $base_url . '/js/jquery.maskedinput.min.js', array( 'jquery' ), $version , true);
    wp_register_script( 'gform_menu', $base_url . "/js/menu{$min}.js", array( 'jquery' ), $version , true);
    wp_register_script( 'gform_placeholder', $base_url . '/js/placeholders.jquery.min.js', array( 'jquery' ), $version , true);
    wp_register_script( 'gform_tooltip_init', $base_url . "/js/tooltip_init{$min}.js", array( 'jquery-ui-tooltip' ), $version , true);
    wp_register_script( 'gform_textarea_counter', $base_url . '/js/jquery.textareaCounter.plugin.js', array( 'jquery' ), $version , true);
    wp_register_script( 'gform_field_filter', $base_url . "/js/gf_field_filter{$min}.js", array( 'jquery', 'gform_datepicker_init' ), $version , true);
    wp_register_script( 'gform_shortcode_ui', $base_url . "/js/shortcode-ui{$min}.js", array( 'jquery', 'wp-backbone' ), $version, true );

    wp_register_style( 'gform_shortcode_ui', $base_url . "/css/shortcode-ui{$min}.css", array(), $version );

    // only required for WP versions prior to 3.3
    wp_register_script( 'gf_thickbox', $base_url . '/js/thickbox.js', array(), $version , true);
    wp_register_style( 'gf_thickbox', $base_url . '/js/thickbox.css', array(), $version , true);
    wp_localize_script(
    'gf_thickbox', 'thickboxL10n', array(
        'next'             => esc_html__( 'Next >', 'gravityforms' ),
        'prev'             => esc_html__( '< Prev', 'gravityforms' ),
        'image'            => esc_html__( 'Image', 'gravityforms' ),
        'of'               => esc_html__( 'of', 'gravityforms' ),
        'close'            => esc_html__( 'Close', 'gravityforms' ),
        'noiframes'        => esc_html__( 'This feature requires inline frames. You have iframes disabled or your browser does not support them.', 'gravityforms' ),
        'loadingAnimation' => includes_url( 'js/thickbox/loadingAnimation.gif' ),
        'closeImage'       => includes_url( 'js/thickbox/tb-close.png' )
        )
    );
}

function ds_enqueue_jquery_in_footer( &$scripts ) {

    if ( ! is_admin() )
    $scripts->add_data( 'jquery', 'group', 1 );
}
add_action( 'wp_default_scripts', 'ds_enqueue_jquery_in_footer' );



// Force Gravity Forms to init scripts in the footer and ensure that the DOM is loaded before scripts are executed
add_filter( 'gform_init_scripts_footer', '__return_true' );
add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open', 1 );
function wrap_gform_cdata_open( $content = '' ) {
    if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) {
        return $content;
    }
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
        return $content;
    }

    add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close', 99 );
    function wrap_gform_cdata_close( $content = '' ) {
        if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) {
            return $content;
        }
        $content = ' }, false );';
        return $content;
    }
