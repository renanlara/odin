<section id="showcase" class="vitrine">
	<?php
		$showcase = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => 4,
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
				    		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'slider', array( 'class' => 'img-responsive' ) ); ?></a>
				    	</figure>
		    			<article class="entry-content col-lg-6 col-md-6 col-sm-6 col-xs-12">
		    				<?php the_title( '<h2 class="entry-title"><a href=" ' . get_permalink($post->ID) . ' ">', '</a></h2>' ); ?>
				    		<?php the_excerpt(); ?>
				    		<nav class="nav-slides"></nav>
				    	</article><!-- .entry-content -->
				    </div><!-- .row -->
			    </div><!-- .slides -->
		    <?php endwhile; ?>

		    <?php wp_reset_postdata(); ?>

		</div><!-- .cycle-slideshow -->
	<?php else : ?>
		<p><?php _e( 'Desculpe, sem itens para exibir.' ); ?></p>
	<?php endif; ?>
</section><!-- #showcase -->
