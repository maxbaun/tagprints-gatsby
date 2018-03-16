<?php

function codex_custom_init_lookbook() {
	$labels = array(
		'name'               => 'LookBooks',
		'singular_name'      => 'LookBook',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New LookBook',
		'edit_item'          => 'Edit LookBook',
		'new_item'           => 'New LookBook',
		'all_items'          => 'All LookBooks',
		'view_item'          => 'View LookBook',
		'search_items'       => 'Search LookBooks',
		'not_found'          => 'No LookBook found',
		'not_found_in_trash' => 'No LookBook found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'LookBooks'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'lookbook'),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'       => true,
		'rest_base'          => 'lookbook',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields')
	);

	register_post_type('lookbook', $args);
}


add_action('init', 'codex_custom_init_lookbook');

// ACF Stuff

if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group(array(
		'key' => 'group_5a9d9999505d2',
		'title' => 'Lookbooks',
		'fields' => array(
			array(
				'key' => 'field_5a9d999e2b2a4',
				'label' => 'Link',
				'name' => 'link',
				'type' => 'link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
			),
			array(
				'key' => 'field_5a9d99ae2b2a5',
				'label' => 'Gallery',
				'name' => 'gallery',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'insert' => 'append',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'lookbook',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
			1 => 'excerpt',
			2 => 'discussion',
			3 => 'comments',
			4 => 'revisions',
			5 => 'author',
			6 => 'page_attributes',
			7 => 'featured_image',
			8 => 'categories',
			9 => 'tags',
		),
		'active' => 1,
		'description' => '',
	));
}

// END ACF Stuff
?>
