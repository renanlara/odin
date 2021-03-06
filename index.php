<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="home-template page-default" tabindex="-1" role="main">
		<div class="container">
			<?php
				get_template_part( 'templates/breadcrumb' );
				get_template_part( 'templates/slider' );
			?>

			<div class="row">
				<div class="<?php echo odin_classes_page_sidebar(); ?>">
					<?php
						if ( have_posts() ) :
							// Start the Loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the post format-specific template for the content. If you want to
								 * use this in a child theme, then include a file called called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );

							endwhile;

							// Post navigation.
							odin_paging_nav();

						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>
				</div><!-- .odin_classes_page_sidebar() -->

				<?php get_sidebar(); ?>

			</div><!-- .row -->
		</div><!-- .container -->
	</main><!-- #content -->

<?php
get_footer();
