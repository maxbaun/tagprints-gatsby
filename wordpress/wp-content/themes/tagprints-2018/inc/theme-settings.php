<?php

$theme_options = array();

class TagprintsSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this,'add_plugin_page') ) ;
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'theme-settings' , array($this,'create_admin_page'));
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'tp_option' );
        ?>
        <div class="wrap">
            <h2>My Settings</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'tp_option_group' );
                do_settings_sections( 'tp-settings' );
                submit_button();
            ?>
            </form>
        </div>

        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'tp_option_group', // Option group
            'tp_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        $this->init_logo_section();
        $this->init_cta_section();
        $this->init_social_section();
        $this->init_case_studies_section();
    }

    /*********
    LOGO SECTION
    **********/
    public function init_logo_section(){

        add_settings_section(
            'logo_section_id', // ID
            'Logo Settings', // Title
            array( $this, 'logo_settings_info' ), // Callback
            'tp-settings' // Page
        );

        add_settings_field(
            'logo_image',
            'Logo Image',
            array( $this, 'logo_image_callback'),
            'tp-settings',
            'logo_section_id'
        );
    }
    public function logo_settings_info()
    {
       print 'Upload an image to use as the logo (328x64 minimum):';
    }
    public function logo_image_callback()
    {
      ?>
          <input type="text" id="logo_image" name="tp_option[logo_image]" value="<?php echo esc_url( $this->options['logo_image'] ); ?>" />
          <input type="hidden" id="logo_image_id" name="tp_option[logo_image_id]" value="<?php echo $this->options['logo_image_id']; ?>" />
          <input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'tagprints' ); ?>" />
          <span class="description"><?php _e('Upload an image for the banner.', 'tagprints' ); ?></span>
      <?php
    }

    /*********
    END LOGO SECTION
    **********/

    /*********
		CTA SECTION
    **********/
    public function init_cta_section(){

        add_settings_section(
            'call_to_action_section_id', // ID
            'Call To Action Settings', // Title
            array( $this, 'call_to_action_section_info' ), // Callback
            'tp-settings' // Page
        );

        add_settings_field(
            'cta_text',
            'Text',
            array( $this, 'cta_text_callback'),
            'tp-settings',
            'call_to_action_section_id'
        );

        add_settings_field(
            'cta_page',
            'Page',
            array( $this, 'cta_page_callback'),
            'tp-settings',
            'call_to_action_section_id'
        );
    }
    public function call_to_action_section_info()
    {
       print 'Enter the call to action settings below:';
    }
    public function cta_text_callback()
    {
      printf(
        '<input type="text" id="cta_text" name="tp_option[cta_text]" value="%s" />',
        isset( $this->options['cta_text'] ) ? esc_attr( $this->options['cta_text']) : ''
      );
    }

    public function cta_page_callback()
    {
        printf('<select id="cta_page" name="tp_option[cta_page]"> value="%s"',
            isset( $this->options['cta_page'] ) ? esc_attr( $this->options['cta_page']) : ''
        );
        foreach(getAllPages() as $page){
            printf(
                '<option %s value="%s">%s</option>'
                ,
                (absint($page->ID) == esc_attr( $this->options['cta_page']) ) ? 'selected="selected"' : '',
                absint($page->ID),
                $page->post_title
            );
        }
        printf('</select>');

    }
    /*********
		END CTA SECTION
    **********/


    /*********
		SOCIAL SECTION
    **********/
    public function init_social_section(){
      add_settings_section(
          'social_settings_id', // ID
          'Social Settings', // Title
          array( $this, 'social_settings_info' ), // Callback
          'tp-settings' // Page
      );

      add_settings_field(
          'facebook_show',
          'Show Facebook Icon?',
          array( $this, 'facebook_show_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'facebook_url',
          'Facebook URL',
          array( $this, 'facebook_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'twitter_show',
          'Show Twitter Icon?',
          array( $this, 'twitter_show_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'twitter_url',
          'Twitter URL',
          array( $this, 'twitter_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'instagram_show',
          'Show Instagram Icon?',
          array( $this, 'instagram_show_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'instagram_url',
          'Instagram URL',
          array( $this, 'instagram_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'phone_show',
          'Show Phone Icon?',
          array( $this, 'phone_show_callback'),
          'tp-settings',
          'social_settings_id'
      );

      add_settings_field(
          'phone_number',
          'Phone Number',
          array( $this, 'phone_callback'),
          'tp-settings',
          'social_settings_id'
      );



      add_settings_field(
          'contact_email',
          'Contact Email Address',
          array( $this, 'contact_email_callback'),
          'tp-settings',
          'social_settings_id'
      );
    }
    public function social_settings_info()
    {
        print 'Enter the social media settings below:';
    }

    public function facebook_callback(){
        printf(
            '<input type="text" id="facebook_url" name="tp_option[facebook_url]" value="%s" />',
            isset( $this->options['facebook_url'] ) ? esc_attr( $this->options['facebook_url']) : ''
        );
    }

    public function facebook_show_callback(){
        if(isset($this->options['facebook_show']) && $this->options['facebook_show'] == 'on'){
          printf(
              '<input type="checkbox" id="facebook_show" name="tp_option[facebook_show]" checked />'
          );
        } else{
          printf(
              '<input type="checkbox" id="facebook_show" name="tp_option[facebook_show]" />'
          );
        }
    }

    public function twitter_callback(){
        printf(
            '<input type="text" id="twitter_url" name="tp_option[twitter_url]" value="%s" />',
            isset( $this->options['twitter_url'] ) ? esc_attr( $this->options['twitter_url']) : ''
        );
    }

    public function twitter_show_callback(){
        if(isset($this->options['twitter_show']) && $this->options['twitter_show'] == 'on'){
          printf(
              '<input type="checkbox" id="twitter_show" name="tp_option[twitter_show]" checked />'
          );
        } else{
          printf(
              '<input type="checkbox" id="twitter_show" name="tp_option[twitter_show]" />'
          );
        }
    }

    public function instagram_callback(){
        printf(
            '<input type="text" id="instagram_url" name="tp_option[instagram_url]" value="%s" />',
            isset( $this->options['instagram_url'] ) ? esc_attr( $this->options['instagram_url']) : ''
        );
    }

    public function instagram_show_callback(){
        if(isset($this->options['instagram_show']) && $this->options['instagram_show'] == 'on'){
          printf(
              '<input type="checkbox" id="instagram_show" name="tp_option[instagram_show]" checked />'
          );
        } else{
          printf(
              '<input type="checkbox" id="instagram_show" name="tp_option[instagram_show]" />'
          );
        }
    }

    public function phone_callback(){
        printf(
            '<input type="text" id="phone_number" name="tp_option[phone_number]" value="%s" />',
            isset( $this->options['phone_number'] ) ? esc_attr( $this->options['phone_number']) : ''
        );
    }

    public function phone_show_callback(){
        if(isset($this->options['phone_show']) && $this->options['phone_show'] == 'on'){
          printf(
              '<input type="checkbox" id="phone_show" name="tp_option[phone_show]" checked />'
          );
        } else{
          printf(
              '<input type="checkbox" id="phone_show" name="tp_option[phone_show]" />'
          );
        }
    }

    public function contact_email_callback(){
        printf(
            '<input type="email" id="contact_email" name="tp_option[contact_email]" value="%s" />',
            isset( $this->options['contact_email'] ) ? esc_attr( $this->options['contact_email']) : ''
        );
    }
    /*********
		END SOCIAL SECTION
    **********/


    /*********
		CASE STUDY SECTION
    **********/
    public function init_case_studies_section(){
      add_settings_section(
          'case_study_settings_id', // ID
          'Case Study Settings', // Title
          array( $this, 'case_study_settings' ), // Callback
          'tp-settings' // Page
      );

      add_settings_field(
          'case_study_back_text',
          'Back Button Text',
          array( $this, 'case_study_back_text_callback'),
          'tp-settings',
          'case_study_settings_id'
      );

      add_settings_field(
          'case_study_main_page',
          'Case Study Main Page',
          array( $this, 'case_study_main_page_callback'),
          'tp-settings',
          'case_study_settings_id'
      );

      add_settings_field(
          'our_work_page',
          'Our Work Page',
          array( $this, 'our_work_page_callback'),
          'tp-settings',
          'case_study_settings_id'
      );

    }
    public function case_study_settings()
    {
        print 'Enter the Case Study settings below:';
    }

    public function case_study_back_text_callback(){
        printf(
            '<input type="text" id="case_study_back_text" name="tp_option[case_study_back_text]" value="%s" />',
            isset( $this->options['case_study_back_text'] ) ? esc_attr( $this->options['case_study_back_text']) : ''
        );
    }

    public function case_study_main_page_callback()
    {
        printf('<select id="case_study_main_page" name="tp_option[case_study_main_page]"> value="%s"',
            isset( $this->options['case_study_main_page'] ) ? esc_attr( $this->options['case_study_main_page']) : ''
        );
        foreach(getAllPages() as $page){
            printf(
                '<option %s value="%s">%s</option>'
                ,
                (absint($page->ID) == esc_attr( $this->options['case_study_main_page']) ) ? 'selected="selected"' : '',
                absint($page->ID),
                $page->post_title
            );
        }
        printf('</select>');

    }

    public function our_work_page_callback()
    {
        printf('<select id="our_work_page" name="tp_option[our_work_page]"> value="%s"',
            isset( $this->options['our_work_page'] ) ? esc_attr( $this->options['our_work_page']) : ''
        );
        foreach(getAllPages() as $page){
            printf(
                '<option %s value="%s">%s</option>'
                ,
                (absint($page->ID) == esc_attr( $this->options['our_work_page']) ) ? 'selected="selected"' : '',
                absint($page->ID),
                $page->post_title
            );
        }
        printf('</select>');

    }

    /*********
		END CASE STUDY SECTION
    **********/

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['cta_text'] ) )
            $new_input['cta_text'] = sanitize_text_field( $input['cta_text'] );

        if( isset( $input['cta_page'] ) )
            $new_input['cta_page'] = $input['cta_page'];

        if( isset( $input['facebook_url'] ) )
            $new_input['facebook_url'] = sanitize_option('facebook_url', $input['facebook_url'] );

        if( isset( $input['facebook_show'] ) )
            $new_input['facebook_show'] = sanitize_option('facebook_show', $input['facebook_show'] );

        if( isset( $input['twitter_url'] ) )
            $new_input['twitter_url'] = sanitize_option('twitter_url', $input['twitter_url'] );

        if( isset( $input['twitter_show'] ) )
            $new_input['twitter_show'] = sanitize_option('twitter_show', $input['twitter_show'] );

        if( isset( $input['instagram_url'] ) )
            $new_input['instagram_url'] = sanitize_option('instagram_url', $input['instagram_url'] );

        if( isset( $input['instagram_show'] ) )
            $new_input['instagram_show'] = sanitize_option('instagram_show', $input['instagram_show'] );

        if( isset( $input['phone_number'] ) )
            $new_input['phone_number'] = sanitize_option('phone_number', $input['phone_number'] );

        if( isset( $input['phone_show'] ) )
            $new_input['phone_show'] = sanitize_option('phone_show', $input['phone_show'] );


        if( isset( $input['contact_email'] ) )
            $new_input['contact_email'] = sanitize_option('contact_email', $input['contact_email'] );

        if( isset($input['logo_image']))
          $new_input['logo_image'] = sanitize_option('logo_image',$input['logo_image']);

        if( isset($input['logo_image_id']))
          $new_input['logo_image_id'] = sanitize_option('logo_image_id',$input['logo_image_id']);

        if( isset($input['case_study_back_text']))
          $new_input['case_study_back_text'] = sanitize_option('case_study_back_text',$input['case_study_back_text']);
        if( isset( $input['case_study_main_page'] ) )
            $new_input['case_study_main_page'] = $input['case_study_main_page'];
        if( isset( $input['our_work_page'] ) )
            $new_input['our_work_page'] = $input['our_work_page'];

        return $new_input;
    }
}

if( is_admin() ){
  $settings_page = new TagprintsSettingsPage();
  add_action('admin_enqueue_scripts', 'tagprints_options_enqueue_scripts');
}


function tagprints_options_enqueue_scripts() {
  wp_register_script('tagprints/js', asset_path('scripts/main.js'), array('jquery','media-upload','thickbox') );

  if ( 'appearance_page_theme-settings' == get_current_screen()->id ) {
    wp_enqueue_script('jquery');

    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    wp_enqueue_script('media-upload');
    wp_enqueue_script( 'tagprints/js');
  }
}

function getThemeSettingsForFrontend(){
    global $TAGPRINTS_THEME_SETTINGS;
    $theme_options = get_option('tp_option');
    $TAGPRINTS_THEME_SETTINGS = $theme_options;
}

if (!is_admin()){
    add_action('init', 'getThemeSettingsForFrontend');
}

function getSetting($setting){
    global $TAGPRINTS_THEME_SETTINGS;
    $theme_options = $TAGPRINTS_THEME_SETTINGS;
    $ret = (isset($theme_options[$setting])) ? $theme_options[$setting] : '' ;
    return $ret;
}

function getAllPages(){
  $args = array(
    'sort_order' => 'ASC',
    'sort_column' => 'post_title',
    'hierarchical' => 1,
    'exclude' => '',
    'include' => '',
    'meta_key' => '',
    'meta_value' => '',
    'authors' => '',
    'child_of' => 0,
    'parent' => -1,
    'exclude_tree' => '',
    'number' => '',
    'offset' => 0,
    'post_type' => 'page',
    'post_status' => 'publish'
  );
  $pages = get_pages($args);


  return $pages;
}
