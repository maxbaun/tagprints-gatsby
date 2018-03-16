<?php get_template_part('templates/includes/head'); ?>

<div class="wrap" role="document">
  <div class="content">
      <div class="container">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <section class="white">
                  <h1 class="title medium"><?php echo get_the_title(); ?></h1>

                  <div class="entry-attachment text-center">
                      <?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                          <p class="attachment">
                              <a href="<?php echo wp_get_attachment_url($post->id); ?>"
                                  title="<?php the_title(); ?>" rel="attachment">
                                  <img src="<?php echo $att_image[0];?>"
                                  width="<?php echo $att_image[1];?>"
                                  height="<?php echo $att_image[2];?>"
                                  class="attachment-medium"
                                  alt="<?php $post->post_excerpt; ?>" /></a>
                          </p>
                      <?php else : ?>
                          <a href="<?php echo wp_get_attachment_url($post->ID) ?>"
                              title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>"
                              rel="attachment"><?php echo basename($post->guid) ?>
                          </a>
                      <?php endif; ?>
                  </div>
              </section>
          <?php endwhile; else: ?>
              <?php get_template_part('templates/content/empty'); ?>
          <?php endif; ?>
      </div>
  </div><!-- /.content -->
</div><!-- /.wrap -->

<?php get_template_part('templates/includes/foot'); ?>
