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
								<h4 class="title-meta"><?php _e( 'Deixe o seu comentário!', 'odin' ); ?></h4>
								<?php comments_template(); ?>
							</section><!-- #comments-area -->
					<?php
						endif;
					?>
				</div><!-- .odin_classes_page_sidebar() -->

				<?php get_sidebar(); ?>

			</div><!-- .container -->

			<?php
			/**
			 * Listing posts from Blog.
			 * @param > $subtitle_section, $count_posts, $type_post -> array( $post->ID )
			 *
			 **/
				blog_list_posts_and_related( 'Você poderá gostar também', 3, array( $post->ID ) );
			?>
		</main><!-- #main -->

<?php
get_footer();
