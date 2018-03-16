<article <?php post_class('excerpt'); ?>>
  <header>
    <h1 class="title medium text-center"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
    <?php get_template_part('templates/includes/entry', 'meta'); ?>
    <div class="text-center"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-featured'); ?></a></div>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  <div class="text-right">
   <?php echo do_shortcode('[cta text="Read More" link="'.get_the_permalink().'" center="false" class="btn btn-cta-transparent readmore"][/cta]'); ?>
  </div>
</article>
