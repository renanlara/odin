<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

		<main id="content" class="page-default" tabindex="-1" role="main">
			<div class="container">
				<?php get_template_part( 'templates/breadcrumb' ); ?>

				<div class="<?php echo odin_classes_page_sidebar(); ?>">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );

							endwhile;

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) : ?>
							<section id="comments-area">
								<?php
									$social_warfare = "[social_warfare]";

									// The is_plugin_active() function is only included by default in the admin,
									// load it on the front-end too if needed.
									if ( ! function_exists('is_plugin_active') ) {
									    include_once ABSPATH.'wp-admin/includes/plugin.php';
									}
									if ( ! is_plugin_active( 'social-warfare/social-warfare.php' ) ) : ?>
										<div class="alert alert-danger" role="alert"><?php _e( 'The plugin', 'odin' ); ?> <a href="https://br.wordpress.org/plugins/social-warfare/" target="_blank"><?php _e( 'Social Warfare', 'odin' ); ?></a> <?php _e( 'not it is installed. The social media share not it will be displayed.', 'odin' ); ?></div>

									<?php
										else : ?>
										<h3><?php _e( 'Share:', 'odin' ); ?></h3>
										<?php echo do_shortcode( $social_warfare );
									endif;
								?>

								<h3><?php _e( 'Leave your comment!', 'odin' ); ?></h3>
								<?php comments_template(); ?>
							</section><!-- #comments-area -->
					<?php
						endif;
					?>
				</div><!-- .odin_classes_page_sidebar() -->

				<?php get_sidebar(); ?>

			</div><!-- .container -->

			<?php blog_list_posts_and_related( 'Você pode gostar também:', 3, $last_posts ); ?>
		</main><!-- #main -->

<?php
get_footer();
