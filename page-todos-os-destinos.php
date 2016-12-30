<?php
/**
 * Template Name: Destinos
 * The template for displaying all pages.
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
			<?php get_template_part( 'templates/breadcrumb' ); ?>

			<div class="<?php echo odin_classes_page_full(); ?>">
				<?php
					echo '<ul class="nav nav-tabs" role="tablist">';

					$taxonomy = 'destino';
					$post_type = 'post';
					$custom_terms = get_terms( $taxonomy );
					$count_tab = 0;

					foreach( $custom_terms as $custom_term) {
					    wp_reset_query();
					    $args = array(
					    	'post_type' => $post_type,
					        'tax_query' => array(
					            array(
					                'taxonomy' => $taxonomy,
					                'field' => 'slug',
					                'terms' => $custom_term->slug,
					            ),
					        ),
					    );

					?>
				     	<li role="presentation" class=" <?=($count_tab == 1) ? 'active' : '' ?>"><a href="#post-<?php echo $count_tab; ?>" aria-controls="post-<?php echo $count_tab; ?>" role="tab" data-toggle="tab"><?php echo $custom_term->name; ?></a></li>
				    <?php
					}

					echo '</ul>';

				?>
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
			</div><!-- .odin_classes_page_full() -->
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();
