<?php
/**
 * WordPress Search Form Template
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only"><?php _esc_html_e( 'Search for:', 'cutlass' ); ?></label>
	<input type="text" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _esc_html_e( 'Search', 'cutlass' ); ?> <?php bloginfo( 'name' ); ?>">
	<div class="text-left" style="margin-top: 15px;">
		<button type="submit" class="search-submit btn btn-cta">Search <span class="fa fa-search"></span></button>
	</div>
</form>
