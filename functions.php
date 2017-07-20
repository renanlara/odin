<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
//require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Odin 2.2.10
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Html5Shiv
	wp_enqueue_script( 'html5shiv', $template_url . '/assets/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Cycle2 plugins
	wp_enqueue_script( 'cycle2', $template_url . '/assets/js/jquery.cycle2.min.js', array(), null, true );
	wp_enqueue_script( 'cycle2.carousel', $template_url . '/assets/js/jquery.cycle2.carousel.min.js', array(), null, true );
	wp_enqueue_script( 'cycle2.scrollVert', $template_url . '/assets/js/jquery.cycle2.scrollVert.min.js', array(), null, true );
	wp_enqueue_script( 'cycle2.swipe', $template_url . '/assets/js/jquery.cycle2.swipe.min.js', array(), null, true );

	// lightSlider
	wp_enqueue_script( 'lightslider', $template_url . '/assets/js/lightslider.js', array(), null, true );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}

/**
 * Custom Functions for the theme of Client.
 **/

// Alert for plugins not installeds or not actives
function agile_engine_branding_errors_notice() {
	$defaul_message_plugin_not_installed = __( 'não está instalado. Instale ou ative o plugin.', 'odin' );
	// The is_plugin_active() function is only included by default in the admin,
	// load it on the front-end too if needed.
	if ( ! function_exists('is_plugin_active') ) {
	    include_once ABSPATH.'wp-admin/includes/plugin.php';
	}

	// Advanced Custom Fields Pro
	if ( ! is_plugin_active( 'advanced-custom-fields/acf.php' ) && ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) { ?>
	    <div class="notice notice-error is-dismissible">
	        <p><a href="<?php echo admin_url( 'plugin-install.php?s=Advanced+Custom+Fields&tab=search&type=term', 'http' ); ?>"><?php _e( 'Advanced Custom Fields ou ACF Pro', 'odin' ); ?></a> <?php echo $defaul_message_plugin_not_installed; ?></p>
	    </div>
	    <?php
	}

	// Contact Form 7
	if ( ! is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) { ?>
	    <div class="notice notice-error is-dismissible">
	        <p><a href="<?php echo admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term', 'http' ); ?>"><?php _e( 'Contact Form 7', 'odin' ); ?></a> <?php echo $defaul_message_plugin_not_installed; ?></p>
	    </div>
	    <?php
	}

	// Yoast SEO
	if ( ! is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) { ?>
	    <div class="notice notice-error is-dismissible">
	        <p><a href="<?php echo admin_url( 'plugin-install.php?s=Yoast+SEO&tab=search&type=term', 'http' ); ?>"><?php _e( 'Yoast SEO', 'odin' ); ?></a> <?php echo $defaul_message_plugin_not_installed; ?></p>
	    </div>
	    <?php
	}

}
add_action( 'admin_notices', 'agile_engine_branding_errors_notice' );

/**
 * Images Sizes - Agile Engine Branding
 **/
add_image_size( 'page-full', 1170, 690, true );
add_image_size( 'page-with-sidebar', 760, 450, true );
add_image_size( 'slider', 570, 570, true );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more( $more ) {
    global $post;
	return '...</p><a class="btn btn-aeb-excerpt" href="' . get_permalink($post->ID) . '">Leia Mais</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
* @param $length
* @return int
*/

function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Listing posts from Blog
if ( ! function_exists( 'blog_list_posts_and_related' ) ) {

	/**
	 * Classes Listing posts from Blog.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 * @param > $subtitle_section, $count_posts, $type_post
	 */
	function blog_list_posts_and_related( $subtitle_section, $count_posts, $type_post ) { ?>
		<section id="blog" class="blog-cards">
			<div class="container">
				<header class="entry-header">
					<h2 class="section-title"><?php echo $subtitle_section; ?></h2>
				</header>
				<?php
					$blog = new WP_Query(
					array(
						'post_type' => 'post',
						'posts_per_page' => $count_posts,
						'post__not_in' => $type_post
						)
					);

					if ($count_posts == 1 ) {
						$count_posts = 'col-lg-12 col-md-12 col-sm-12';

					} elseif ($count_posts == 2) {
						$count_posts = 'col-lg-6 col-md-6 col-sm-6';
					} elseif ($count_posts == 3) {
						$count_posts = 'col-lg-4 col-md-4 col-sm-4';
					} elseif ($count_posts < 3) {
						$count_posts = 'col-lg-4 col-md-4 col-sm-4';
					}

				?>
				<?php if ( $blog->have_posts() ) : ?>
					<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
						<div class="entry-post <?php echo $count_posts; ?> col-xs-12">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'page-with-sidebar', array( 'class' => 'img-responsive' ) ); ?></a>
							<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
							<div class="entry-meta">
								<?php odin_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php the_excerpt(); ?>
						</div>
					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				<?php else : ?>
					<p><?php _e( 'Desculpe, sem itens para exibir.' ); ?></p>
				<?php endif; ?>
			</div><!-- .container -->
		</section><!-- #blog -->
	<?php }
}

// Theme Options - ACF
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Opções do Tema',
		'menu_title'	=> 'Opções do Tema',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	/* acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	)); */

}

// Social Media
if ( ! function_exists( 'social_media' ) ) {
	/**
	 * Classes Listing of social media icons.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function social_media( $side ) { ?>
		<section class="social-media <?php echo $side; ?>">
			<?php if( have_rows( 'social_media', 'option' ) ): ?>
			<nav class="navbar-social-media-navigation">
				<ul class="nav navbar-nav">
					<?php while ( have_rows( 'social_media', 'option' ) ) : the_row(); ?>
					<li class="menu-item">
						<a href="<?php the_sub_field( 'url_da_rede_social', 'option' ); ?>" target="_blank" style="background: <?php the_sub_field( 'cor_de_fundo', 'option' ); ?>;">
							<i class="<?php the_sub_field( 'icone_da_rede_social', 'option' ); ?>" aria-hidden="true"></i>
						</a>
					</li>
					<?php endwhile; ?>
				</ul>
			</nav>
			<?php endif; ?>
		</section>
		<?php
	}
}

