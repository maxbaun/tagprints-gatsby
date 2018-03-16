<div id="lightbox-modal" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
  <div class='lightbox-content'>
    <div class="lightbox-caption"><p></p></div>
  </div>
</div>

<?php if ( is_active_sidebar( 'free_quote_modal' ) ) : ?>
  <?php dynamic_sidebar( 'free_quote_modal' ); ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'array13_modal' ) ) : ?>
  <?php dynamic_sidebar( 'array13_modal' ); ?>
<?php endif; ?>
