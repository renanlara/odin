<?php
/**
 * The template for displaying from Front Pages or Home.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="page-default" tabindex="-1" role="main">
		<div class="container">
			<div class="<?php echo odin_classes_page_full(); ?>">
				<?php
					get_template_part( 'templates/slider' );
					// Start the Loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile;
				?>
			</div><!-- .odin_classes_page_full() -->
		</div><!-- .container -->

		<?php
		/**
		 * Listing posts from Blog.
		 * @param > $subtitle_section, $count_posts, $type_post -> array( $post->ID )
		 *
		 **/
			blog_list_posts_and_related( 'Blog', 3, $type_post );
		?>
	</main><!-- #main -->

<?php
get_footer();
