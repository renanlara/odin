<section id="showcase" class="vitrine">
<?php
/**
 * Seleção no Painel de Escolhas.
 *
 * Template Slider Lasts Posts, está definido para exibir os últimos posts.
 * Template Slider Manual Selection, está definito para uso manual, inserção do conteúdo na página Home.
 */

$template = get_field( 'template_slider_showcase', 'options' );

if ( $template == 'ultimos-posts' ) :

	/**
	 * Template Slider Lasts Posts
	 **/
	$showcase = new WP_Query(
	array(
		'post_type' => 'post',
		'posts_per_page' => 4,
		'order'   => 'ASC',
		)
	);
	if ( $showcase->have_posts() ) : ?>
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

<?php
elseif ( $template == 'slider-manual') :
	/**
	 * Template Slider Manual Selection
	**/
	if ( have_rows( 'showcase' ) ) : ?>
		<div class="cycle-slideshow" data-cycle-fx="fade" data-cycle-slides=".slides" data-cycle-swipe="true" data-cycle-timeout="8000" data-cycle-pager=".nav-slides">
			<?php while ( have_rows( 'showcase' ) ) : the_row(); ?>
			    <div class="slides">
				    <div class="row">
				    	<figure class="entry-image col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    		<a href="<?php the_sub_field( 'url_showcase' ); ?>" title="<?php the_sub_field( 'titulo_showcase' ); ?>"><img class="img-responsive" src="<?php the_sub_field( 'imagem_destacada_showcase' ); ?>" alt="<?php the_sub_field( 'titulo_showcase' ); ?>"></a>
				    	</figure>
		    			<article class="entry-content col-lg-6 col-md-6 col-sm-6 col-xs-12">
		    				<h2 class="entry-title"><a href="<?php the_sub_field( 'url_showcase' ); ?>"><?php the_sub_field( 'titulo_showcase' ); ?></a></h2>
				    		<p><?php the_sub_field( 'resumo_showcase' ); ?></p>
				    		<a class="btn-aeb-excerpt" href="<?php the_sub_field( 'url_showcase' ); ?>"><?php the_sub_field( 'nome_do_botao_showcase' ); ?></a>
				    		<nav class="nav-slides"></nav>
				    	</article><!-- .entry-content -->
				    </div><!-- .row -->
			    </div><!-- .slides -->
		    <?php endwhile; ?>
		</div><!-- .cycle-slideshow -->
	<?php
	endif;
endif;
?>
</section><!-- #showcase -->
