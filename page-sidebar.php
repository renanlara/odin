<?php
/**
 * Template Name: With Sidebar
 *
 * The template for displaying pages with sidebar.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header();
?>

	<main id="content" class="page-default with-sidebar" tabindex="-1" role="main">
		<div class="container">
			<?php get_template_part( 'templates/breadcrumb' ); ?>

			<div class="<?php echo odin_classes_page_sidebar(); ?>">
				<?php
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
			</div><!-- .odin_classes_page_sidebar() -->

			<?php get_sidebar(); ?>

		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();
