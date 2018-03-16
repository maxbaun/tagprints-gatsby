<?php



function codex_custom_init_case_study() {
	$labels = array(
		'name'               => 'Case Studies',
		'singular_name'      => 'Case Study',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Case Study',
		'edit_item'          => 'Edit Case Study',
		'new_item'           => 'New Case Study',
		'all_items'          => 'All Case Studies',
		'view_item'          => 'View Case Study',
		'search_items'       => 'Search Case Studies',
		'not_found'          => 'No Case Study found',
		'not_found_in_trash' => 'No Case Study found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Case Studies'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'case-study'),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'       => true,
		'rest_base'          => 'case-study',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', )
	);

	register_post_type('case_study', $args);
}


add_action('init', 'codex_custom_init_case_study');

add_action('add_meta_boxes', 'case_study_meta_box');
function case_study_meta_box()
{
	add_meta_box('case-study-link', 'Case Study Meta', 'cb_case_study', 'case_study', 'normal', 'high');
}

function cb_case_study($post)
{
	$values = get_post_custom($post->ID);
	$cs_brand_color = isset($values['cs_brand_color']) ? esc_attr($values['cs_brand_color'][0]) : '';

	?>

	<label for="cs_brand_color">Brand Color:</label>
	<input type="text" name="cs_brand_color" id="cs_brand_color" value="<?php echo $cs_brand_color; ?>" style="width:100%;"/>

	<?php
}


add_action('save_post', 'case_study_meta_box_save');
function case_study_meta_box_save($post_id)
{
	// now we can actually save the data
	$allowed = array(
		'a' => array(// on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);

	if (isset($_POST['cs_brand_color'])) {
		update_post_meta($post_id, 'cs_brand_color', wp_kses($_POST['cs_brand_color'], $allowed));
	}
}

function add_case_study_tax() {

	register_taxonomy('case_study_category', 'case_study', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x('Case Study Category', 'taxonomy general name'),
			'singular_name' => _x('Case Study-Category', 'taxonomy singular name'),
			'search_items' =>  __('Search Case Study Categories'),
			'all_items' => __('All Case Study Categories'),
			'parent_item' => __('Parent Case Study Category'),
			'parent_item_colon' => __('Parent Case Study Category:'),
			'edit_item' => __('Edit Case Study Category'),
			'update_item' => __('Update Case Study Category'),
			'add_new_item' => __('Add New Case Study Category'),
			'new_item_name' => __('New Case Study Category Name'),
			'menu_name' => __('Case Study Categories'),
		),

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'case-studies', // This controls the base slug that will display before each term
			'with_front' => false,
			'hierarchical' => true
		),
		'show_in_rest'       => true,
		'rest_base'          => 'case-study-category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	));
}
add_action('init', 'add_case_study_tax');


// ACF Stuff

if (function_exists('acf_add_local_field_group')) {

	acf_add_local_field_group(array(
		'key' => 'group_5a99f03a6aede',
		'title' => 'Case Study',
		'fields' => array(
			array(
				'key' => 'field_5a99f05862ca1',
				'label' => 'Logo',
				'name' => 'logo',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'text',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			),
			array(
				'key' => 'field_5a99f06c62ca2',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'case_study',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

}

// END ACF Stuff
