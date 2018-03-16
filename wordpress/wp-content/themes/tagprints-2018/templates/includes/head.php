<?php
/**
 * Head For The Theme
 *
 * @package - TagPrints 2015 Theme
 */

?>


<!doctype html>
<html class="no-js" style="height:100%;" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<link rel="alternate" type="application/rss+xml" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?> Feed" href="<?php echo esc_url( get_feed_link() ); ?>">
</head>

<?php
$body_classes = array();
$theme = 'default';
if ( is_page_template( 'template-landing.php' ) ) {
	$body_classes[] = 'landing-page';
}
if ( is_page_template( 'template-array13.php' ) ) {
	$theme = 'array13';
}
?>

<body data-theme="<?php echo esc_attr( $theme ); ?>" <?php body_class( implode( ' ', $body_classes ) ); ?> >
  <!--[if lt IE 9]>
	<div class="alert alert-warning">
	  {{ _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'cutlass') }}
	</div>
  <![endif]-->


<?php
if ( ! is_page_template( 'template-landing.php' ) ) {
	get_template_part( 'templates/includes/header' );
}
?>
