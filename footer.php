<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- .row -->
	</div><!-- #wrapper -->

	<footer id="footer" role="contentinfo">
		<div class="container">
			<div class="podocenter col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img class="img-responsive" src="<?php the_field( 'logotipo_options_theme', 'options' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div><!-- .podocenter -->
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<?php social_media( 'right' ); ?>
			</div>
		</div><!-- .container -->
		<div class="container">
			<?php if( have_rows( 'infos_footer', 'options' ) ):
    			while ( have_rows( 'infos_footer', 'options' ) ) : the_row(); ?>
					<div class="footer-itens col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<h4 class="entry-title"><?php the_sub_field( 'titulo_infos_footer', 'options' ); ?></h4>
						<?php the_sub_field( 'conteudo_infos_footer', 'options' ); ?>
					</div>
			<?php
				endwhile;
			endif; ?>
			<div class="footer-itens col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h4 class="entry-title"><?php the_field( 'newsletter_footer', 'options' ); ?></h4>
				<div class="row">
					<?php
						$contact_form_7 = get_field( 'contact_form_7', 'options' );
						echo do_shortcode( $contact_form_7 );
					?>
				</div>
				<a href="http://agenciaagile.com.br/" target="_blank" title="Agência Agile - Marketing de Resultados">
					<img class="agencia-agile pull-right" src="<?php echo get_template_directory_uri(); ?>/assets/images/agenciaagile.png" alt="Agência Agile - Marketing de Resultados">
				</a>
			</div><!-- .footer-itens -->
		</div><!-- .container -->
	</footer><!-- #footer -->

	<?php wp_footer(); ?>
</body>
</html>
