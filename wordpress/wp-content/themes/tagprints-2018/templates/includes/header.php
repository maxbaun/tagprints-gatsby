<?php
/**
 * Commoon Header For The Theme
 *
 * @package - TagPrints 2015 Theme
 */

$logo_theme = 'default';

if ( is_page_template( 'template-array13.php' ) ) {
	$logo_theme = 'array13';
}
?>
<header>
	<div class="banner navbar navbar-social" role="banner">
		<div class="container">
			<?php get_template_part( 'templates/includes/header-social-menu' ); ?>
		</div>
	</div>
	<div class="banner navbar navbar-main" role="banner">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo do_shortcode( '[logo width="164" height="32" theme="' . $logo_theme . '"]' ); ?>
				</a>
			</div>

			<nav class="collapse navbar-collapse" role="navigation">
				<div class="navbar-right">
					<?php if ( has_nav_menu( 'primary_navigation' ) ) : ?>
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary_navigation',
									'menu_class' => 'nav navbar-nav main-navigation',
									'container' => false,
									'walker' => new wp_bootstrap_navwalker(),
								)
							);
						?>
					<?php endif; ?>
					<ul class="nav navbar-nav navbar-cta">
						<li><a class="btn btn-cta-transparent" href="<?php echo esc_url( get_permalink( getSetting( 'cta_page' ) ) ); ?>"><?php echo esc_html( getSetting( 'cta_text' ) ); ?></a></li>
					</ul>
					<?php get_template_part( 'templates/includes/header-social-menu' ); ?>
				</div>
			</nav>
		</div>
	</div>
</header>
