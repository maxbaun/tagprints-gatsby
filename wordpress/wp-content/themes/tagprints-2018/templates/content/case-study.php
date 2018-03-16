<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
      <?php the_content(); ?>
      <section class=" article-footer text-center no-top-padding">

          <?php
            $link = get_permalink(getSetting('cta_page'));
            echo do_shortcode('[cta text="Free Quote" center="false" link="'.$link.'" class="btn btn-cta-transparent readmore"][/cta]');
          ?>
          </div>

      </section>

  </article>
<?php endwhile; else: ?>
  <?php get_template_part('templates/content/empty'); ?>
<?php endif; ?>
<div id="fixed-buttons" class="text-center fixed-bottom">
    <a id="btn-all-case-studies" class="btn btn-cta" href="<?php echo get_permalink(getSetting('case_study_main_page')); ?>"><?php echo getSetting('case_study_back_text'); ?></a>
</div>
