<?php

function custom_init_icon() {
  $labels = array(
    'name'               => 'Icons',
    'singular_name'      => 'Icon',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Icon',
    'edit_item'          => 'Edit Icon',
    'new_item'           => 'New Icon',
    'all_items'          => 'All Icons',
    'view_item'          => 'View Icon',
    'search_items'       => 'Search Icons',
    'not_found'          => 'No Icon found',
    'not_found_in_trash' => 'No Icon found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Icons'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => false,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'icon' ),
    'capability_type'    => 'page',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields',  )
  );

  register_post_type( 'icon', $args );
}


add_action( 'init', 'custom_init_icon' );

?>
