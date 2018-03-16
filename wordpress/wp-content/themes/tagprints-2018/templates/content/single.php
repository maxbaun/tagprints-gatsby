
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="<?php echo get_container_class(); ?>">
      <article <?php post_class('border-bottom'); ?>>
        <header>
          <?php get_template_part('templates/includes/page-header'); ?>
          <?php get_template_part('templates/includes/entry-meta'); ?>
          <?php if(get_post_meta($post->ID,"show-featured-image") !== null && get_post_meta($post->ID,"show-featured-image",true) ): ?>
            <div class="text-center"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-featured'); ?></a></div>
          <?php endif; ?>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <?php $tags = get_the_tags(); if(isset($tags) &&  $tags != false): ?>
        <div class="keywords">
          <?php the_tags( '<ul class="features"><li class="feature">', '</li><li class="feature">', '</li></ul>' ); ?>
        </div>
      <?php endif; ?>
        <footer>
          <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'cutlass'), 'after' => '</p></nav>')); ?>
        </footer>
      </article>
    </div>
  </div>
  <section class="article-footer">
    <?php $related_posts = get_related_posts(); if(count($related_posts) > 0): ?>
    <h1 class="title small">Similar Articles</h1>
    <div class="related-posts">

        <?php

          foreach($related_posts as $related_post):
            $post_thumbnail_id = get_post_thumbnail_id( $related_post->ID );
            $bgImage = backgroundImageStyle($post_thumbnail_id,'blog-featured');
            echo $bgImage;

            $terms = get_the_terms($related_post->ID,'category');

            $categories = array();
            foreach($terms as $term){
              $categories[] = $term->name;
            }

            $author = get_the_author_meta('display_name',$related_post->post_author);
            $permalink = get_permalink($related_post->ID);
        ?>

          <div id="bgimage-<?php echo $post_thumbnail_id; ?>" class="related-post">
            <div class="overlay">
              <a href="<?php echo $permalink; ?>">
                <div class="title"><?php echo $related_post->post_title; ?></div>
                <div class="post-meta">
                  by <span class="author"><?php echo $author; ?></span> / <time class="date" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time><br/>
                  <span class="category"><?php echo implode(', ',$categories); ?></span>
                </div>
              </a>
            </div>
          </div>

        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="text-center">
    <?php
      echo do_shortcode('[cta text="Back To Blog" center="false" link="/blog" class="btn btn-cta-transparent readmore"][/cta]');
    ?>
    </div>
  </section>
<?php endwhile; else: ?>
  <?php get_template_part('templates/content/empty'); ?>
<?php endif; ?>
