<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-container">

		<!-- Left: branding -->
		<div class="footer-branding">
			<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
			<p class="footer-tagline"><?php printf( esc_html__( '%s | Galería de arte y Web oficial de Daniel Milán', 'tremebundus' ), esc_html( get_bloginfo( 'name' ) ) ); ?></p>
		</div>

		<!-- Right: Acerca de + Sígueme en -->
		<div class="footer-links">
			<div class="footer-section footer-about">
				<h3><?php _e( 'Acerca de', 'tremebundus' ); ?></h3>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/bio' ) ); ?>"><?php _e( 'Bio', 'tremebundus' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>"><?php _e( 'Contacto', 'tremebundus' ); ?></a></li>
				</ul>
			</div>

			<div class="footer-section footer-social">
				<h3><?php _e( 'Sígueme en', 'tremebundus' ); ?></h3>
				<ul class="social-links">
					<li><a href="https://www.instagram.com/tremebundus_/" target="_blank" rel="noopener"><?php _e( 'Instagram', 'tremebundus' ); ?></a></li>
					<li><a href="https://www.youtube.com/@Tremebundus13" target="_blank" rel="noopener"><?php _e( 'YouTube', 'tremebundus' ); ?></a></li>
				</ul>
			</div>
		</div>

		<hr class="footer-divider">

		<p class="footer-copy">
			<?php printf( esc_html__( '%s | Galería de arte y Web oficial de Daniel Milán', 'tremebundus' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
		</p>

		<?php wp_footer(); ?>
	</div><!-- .site-container -->
</footer><!-- #colophon -->