<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="page-default 404-template" tabindex="-1" role="main">
		<div class="container">
			<?php get_template_part( 'templates/breadcrumb' ); ?>

			<div class="<?php echo odin_classes_page_full(); ?>">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Not Found', 'odin' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'odin' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</div><!-- .odin_classes_page_full() -->
		</div><!-- .container -->

		<?php
		/**
		 * Listing posts from Blog.
		 * @param > $subtitle_section, $count_posts, $type_post
		 *
		 **/
			blog_list_posts_and_related( 'Veja o que publicamos em nosso blog', 3, $last_posts );
		?>
	</main><!-- #main -->

<?php
get_footer();
