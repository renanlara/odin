<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( ! get_option( 'site_icon' ) ) : ?>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<?php endif; ?>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<script src="https://use.fontawesome.com/02346b213c.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a id="skippy" class="sr-only sr-only-focusable" href="#content">
		<div class="container">
			<span class="skiplink-text"><?php _e( 'Skip to content', 'odin' ); ?></span>
		</div>
	</a>

	<header id="header" role="banner">
		<div class="container">
			<div class="row">
				<div class="brand-header col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<?php odin_the_custom_logo(); ?>

					<?php if ( is_home() ) : ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img class="img-responsive" src="<?php the_field( 'logotipo_options_theme', 'options' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							</a>
						</h1>
					<?php else : ?>
						<div class="site-title h1">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img class="img-responsive" src="<?php the_field( 'logotipo_options_theme', 'options' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							</a>
						</div>
					<?php endif ?>

					<?php if ( get_header_image() ) : ?>
						<div class="custom-header">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							</a>
						</div>
					<?php endif; ?>
				</div><!-- .page-header-->

				<div id="main-navigation" class="navbar col-lg-9 col-md-9 hidden-sm hidden-xs">
					<?php social_media( 'right' ); ?>
					<nav class="navbar-main-navigation" role="navigation">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'depth'          => 2,
									'container'      => false,
									'menu_class'     => 'nav navbar-nav pull-right',
									'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
									'walker'         => new Odin_Bootstrap_Nav_Walker()
								)
							);
						?>
					</nav><!-- .navbar-collapse -->
				</div><!-- #main-navigation-->

				<div id="nav-icon" class="nav-icon pull-right visible-sm visible-xs">
					<span></span>
					<span></span>
					<span></span>
				</div><!-- #nav-icon -->

			</div><!-- .row -->
		</div><!-- .container-->
	</header><!-- #header -->

	<header id="header-mobile" class="visible-sm visible-xs">
		<div class="agile-engine-branding col-xs-8">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php the_field( 'logotipo_options_theme', 'option' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</a>
		</div>

		<div id="nav-icon-close" class="nav-icon open col-xs-2 pull-right">
			<span></span>
			<span></span>
			<span></span>
		</div>

		<div id="main-navigation-mobile" class="navbar col-xs-12">
			<nav class="navbar-main-navigation-mobile" role="navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'depth'          => 2,
							'container'      => false,
							'menu_class'     => 'nav navbar-nav',
							'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
							'walker'         => new Odin_Bootstrap_Nav_Walker()
						)
					);
				?>
			</nav><!-- .navbar-collapse -->
			<?php social_media(); ?>
		</div><!-- #main-navigation-->
	</header><!-- #header-mobile -->

	<div id="wrapper">
