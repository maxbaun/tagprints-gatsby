<section class="white contact-header">
    <div class="container">
        <div class="contact-header-inner">
            <div class="left">
                <a href="tel:<?php echo str_replace('-','',getSetting('phone_number')); ?>">
                    <span class="fa fa-phone"></span>
                    <span class="text"><?php echo getSetting('phone_number'); ?></span>
                </a>
            </div>
            <div class="right">
                <a href="mailto:<?php echo getSetting('contact_email'); ?>">
                    <span class="fa fa-envelope"></span>
                    <span class="text"><?php echo getSetting('contact_email'); ?></span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; else: ?>
    <?php get_template_part('templates/content/empty'); ?>
<?php endif; ?>
