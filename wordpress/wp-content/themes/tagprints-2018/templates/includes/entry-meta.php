<div class="byline author vcard text-center">
    <?php get_avatar(get_the_author_meta('ID'),null,null,null,array("class"=>"avatar")); ?>
    <span class="entry-meta-inner">
        by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author() ?></a> / <?php echo get_the_date(); ?> / <?php the_terms(get_the_ID(),'category'); ?>
    </span>
</div>
