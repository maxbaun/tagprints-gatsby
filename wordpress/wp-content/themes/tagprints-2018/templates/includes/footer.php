<?php
/**
 * Commoon Footer For The Theme
 *
 * @package - TagPrints 2015 Theme
 */

$facebook_show = getSetting( 'facebook_show' );
$twitter_show = getSetting( 'twitter_show' );
$instagram_show = getSetting( 'instagram_show' );
$phone_show = getSetting( 'phone_show' );
?>

<footer class="content-info" role="contentinfo">

	<!-- {{ dynamic_sidebar('sidebar-footer') }} -->
	<div class="footer-menu navbar navbar-main">
		<div class="container">
			<nav class="" role="navigation">
				<?php if ( has_nav_menu( 'footer_navigation' ) ) : ?>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer_navigation',
								'menu_class' => 'nav navbar-nav',
								'walker' => new wp_bootstrap_navwalker(),
								'container' => false,
							)
						);
					?>
				<?php endif; ?>
				<ul class="nav navbar-nav social-icons">
					<?php if ( !empty( $facebook_show ) && 'on' === $facebook_show ) : ?>
						<li><a href="<?php echo esc_attr( getSetting( 'facebook_url' ) ); ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>
					<?php endif; ?>
					<?php if ( !empty( $twitter_show ) && 'on' === $twitter_show ) : ?>
						<li><a href="<?php echo esc_attr( getSetting( 'twitter_url' ) ); ?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
					<?php endif; ?>
					<?php if ( isset( $instagram_show ) && 'on' === $instagram_show ) : ?>
						<li><a href="<?php echo esc_attr( getSetting( 'instagram_url' ) ); ?>" target="_blank"><span class="fa fa-instagram"></span></a></li>
					<?php endif; ?>
				</ul>
			</nav>
		</div>
	</div>
	<?php if ( is_page_template( 'template-array13.php' ) ) : ?>
	<div class="footer-logo">
		<?php echo do_shortcode( '[logo theme="grey" width="350.6" height="68.3"/]' ); ?>
	</div>
	<?php endif; ?>
	<div class="footer-copy">
		<?php dynamic_sidebar( 'copyright_area' ); ?>
	</div>
</footer>
