<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; else: ?>
    <?php get_template_part('templates/content/empty'); ?>
<?php endif; ?>
