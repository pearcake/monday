<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="masthead" class="site-header">
		<div class="site-header__container">
			<?php  if ( function_exists( 'the_custom_logo' ) ) {
				the_custom_logo();
			} ?>
			<?php 
			/**
			 * Usage: bem_menu('menu_location', 'my-menu', array('my-menu--my-modifier','my-menu--my-other-modifier'))
			 * @link https://github.com/roikles/Wordpress-Bem-Menu
			 */
			bem_menu('main', 'nav-links', 'nav-links--main');
			?>
		</div>
	</header><!-- #masthead -->