<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php
		do_action( 'generation_copyright' );
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php printf( esc_html__( '%s', 'tremebundus' ), get_bloginfo( 'name' ) ); ?></a>
		<span class="sep"> | </span>
		<a href="<?php echo esc_url( home_url( '/feed' ) ); ?>"><?php _e( 'RSS', 'tremebundus' ); ?></a>
	</div>

	<!-- Accessibility: focus-visible for footer links -->
	<?php wp_footer(); ?>
</footer><!-- #colophon -->