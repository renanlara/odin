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
				<section id="showcase" class="vitrine">
					<?php
						$showcase = new WP_Query(
						array(
							'post_type' => 'slider',
							'posts_per_page' => -1,
							'order'   => 'ASC',
							)
						);
					?>
					<?php if ( $showcase->have_posts() ) : ?>
						<div class="cycle-slideshow" data-cycle-fx="fade" data-cycle-slides=".slides" data-cycle-swipe="true" data-cycle-timeout="8000" data-cycle-pager=".nav-slides">
							<?php while ( $showcase->have_posts() ) : $showcase->the_post(); ?>
							    <div class="slides">
								    	<div class="row">
								    	<figure class="entry-image col-lg-6 col-md-6 col-sm-6 col-xs-12">
								    		<?php the_post_thumbnail( 'slider', array( 'class' => 'img-responsive' ) ); ?>
								    	</figure>
						    			<article class="entry-content col-lg-6 col-md-6 col-sm-6 col-xs-12">
						    				<?php the_title( '<h2 class="entry-title"><a href=" ' . get_permalink($post->ID) . ' ">', '</a></h2>' ); ?>
								    		<?php the_content(); ?>
								    		<nav class="nav-slides"></nav>
								    	</div><!-- .row -->
							    	</article><!-- .entry-content -->
							    </div><!-- .slides -->
						    <?php endwhile; ?>

						    <?php wp_reset_postdata(); ?>

						</div><!-- .cycle-slideshow -->
					<?php else : ?>
						<p><?php _e( 'Desculpe, sem itens para exibir.' ); ?></p>
					<?php endif; ?>
				</section><!-- #showcase -->
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

		<?php
		/**
		 * Listing posts from Blog.
		 * @param > $subtitle_section, $count_posts, $type_post
		 *
		 **/
			blog_list_posts_and_related( 'Blog', 3, $last_posts );
		?>
	</main><!-- #main -->

<?php
get_footer();
