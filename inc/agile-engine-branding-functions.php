<?php

// Alert for plugins not installeds or not actives
function agile_engine_branding_errors_notice() {
	$defaul_message_plugin_not_installed = __( 'não está instalado. Instale ou Ative o plugin.', 'odin' );
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

	// Contact Form DB
	if ( ! is_plugin_active( 'contact-form-7-to-database-extension/contact-form-7-db.php' ) ) { ?>
	    <div class="notice notice-error is-dismissible">
	        <p><a href="<?php echo admin_url( 'plugin-install.php?s=Contact+Form+DB&tab=search&type=term', 'http' ); ?>"><?php _e( 'Contact Form DB', 'odin' ); ?></a> <?php echo $defaul_message_plugin_not_installed; ?></p>
	    </div>
	    <?php
	}

	// Custom Post Type UI
	if ( ! is_plugin_active( 'custom-post-type-ui/custom-post-type-ui.php' ) ) { ?>
	    <div class="notice notice-error is-dismissible">
	        <p><a href="<?php echo admin_url( 'plugin-install.php?s=Custom+Post+Type+UI&tab=search&type=term', 'http' ); ?>"><?php _e( 'Custom Post Type UI', 'odin' ); ?></a> <?php echo $defaul_message_plugin_not_installed; ?></p>
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

	// Social Warfare
	if ( ! is_plugin_active( 'social-warfare/social-warfare.php' ) ) { ?>
	    <div class="notice notice-error is-dismissible">
	        <p><a href="<?php echo admin_url( 'plugin-install.php?s=Social+Warfare&tab=search&type=term', 'http' ); ?>"><?php _e( 'Social Warfare', 'odin' ); ?></a> <?php echo $defaul_message_plugin_not_installed; ?></p>
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

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
	return '... <a class="excerpt_more" href="'. get_permalink($post->ID) . '">Leia Mais</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

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
	// Variables
	$last_posts = '';
	$related = array( $post->ID );

	function blog_list_posts_and_related( $subtitle_section, $count_posts, $type_post ) { ?>
		<section id="blog">
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
							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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

	/*acf_add_options_sub_page(array(
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
	function social_media() { ?>
		<section class="social-media">
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
