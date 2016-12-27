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
	 */
	$last_posts = '';
	$related = array( $post->ID );

	function blog_list_posts_and_related( $subtitle_section, $count_posts, $type_post ) { ?>
		<section id="blog">
			<div class="container">
				<header class="entry-header">
					<h3 class="entry-subtitle"><?php echo $subtitle_section; ?></h3>
				</header>

				<?php
					$blog = new WP_Query(
					array(
						'post_type' => 'post',
						'posts_per_page' => $count_posts,
						'post__not_in' => $type_post
						)
					);
				?>
				<?php if ( $blog->have_posts() ) : ?>
					<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
						<div class="entry-post col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="entry-meta">
								<?php odin_posted_on(); ?>
							</div><!-- .entry-meta -->
							<time><?php // the_time( 'd/m/y' ); ?></time>
							<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
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
