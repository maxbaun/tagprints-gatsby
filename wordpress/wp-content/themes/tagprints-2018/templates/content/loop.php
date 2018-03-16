<div class="container posts-loop">
	<div class="row">
		<div class="<?php echo get_container_class(); ?>">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('templates/content/excerpt'); ?>
			  <?php endwhile; else: ?>
				  <?php get_template_part('templates/content/empty'); ?>
			  <?php endif; ?>
		</div>
	</div>
</div>

<?php if($wp_query->max_num_pages > 1) : ?>
	<div class="container">
		<div class="row">
			<div class="<?php echo get_container_class(); ?>">
				<nav class="post-nav">
			    <div class="text-center">
			      <a class="previous"><?php next_posts_link(__('&larr; Older posts', 'cutlass')); ?></a>
			      <a class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'cutlass')); ?></a>
			    </div>
		  	</nav>
		  </div>
	  </div>
  </div>
<?php endif; ?>
