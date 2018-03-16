<?php
/*
Template Name: Blog Template
*/
?>

<?php get_template_part('templates/includes/head'); ?>

<main class="main" role="main">
	<?php get_template_part('templates/content/page'); ?>
	<?php
	  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	  $args = array(
	    "post_type" => "post",
	    "paged" => $paged,
	    "posts_per_page" => get_option( 'posts_per_page' )
	  );
	  $wp_query = new WP_Query($args);
	?>
	<?php get_template_part('templates/content/loop'); ?>
	<?php wp_reset_query(); ?>
</main><!-- /.main -->

<?php get_template_part('templates/includes/foot'); ?>
