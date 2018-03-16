<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function tagprints_widgets_init() {

	register_sidebar( array(
		'name'          => 'Copyright Area',
		'id'            => 'copyright_area',
		'before_widget' => '<div class="container">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Free Quote Modal',
		'id'            => 'free_quote_modal',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => 'Array 13 Modal',
		'id'            => 'array13_modal',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
add_action( 'widgets_init', 'tagprints_widgets_init' );



?>
