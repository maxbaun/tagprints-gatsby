<?php
/*
Template Name: Our Work Template
*/
?>

<?php get_template_part('templates/includes/head'); ?>

<main class="main" role="main">
	<div class="tagprints-work-loader" data-module="our-work-loader">
		<div data-loader>
			<div class="tagprints-work-loader-inner">
				<h3>Loading...</h3>
				<img src="<?php echo themeImage('loader.svg'); ?>"/>
			</div>
		</div>
		<div id="tagprints-work" data-app>

		</div>
	</div>
</main><!-- /.main -->

<?php get_template_part('templates/includes/foot'); ?>
