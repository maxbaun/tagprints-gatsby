<?php
/**
 * Template Name: Array13
 *
 * @package - TagPrints 2015 Theme
 */

?>

<?php get_template_part( 'templates/includes/head' ); ?>

<main class="main modal-blur" role="main">
	<?php global $post; echo do_shortcode($post->post_content); ?>
</main>

<?php get_template_part( 'templates/includes/foot' ); ?>
