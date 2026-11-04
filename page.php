<?php
/**
 * Page template
 * ------------------------------------------------------------
 * Displays a static page (e.g. Contacto).
 */

get_header(); ?>

<main id="primary" class="content-area">
	<div class="main-content site-container">

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-header">
				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php
				// Contact form for the Contacto page.
				if ( is_page( 'contacto' ) ) :
					?>
					<div class="contact-info">
						<div class="contact-item">
							<p class="contact-item-label" style="font-family:var(--font-mono);font-size:var(--type-xs);color:var(--color-accent);margin:0 0 var(--space-xs);"><?php _e( 'Escríbeme', 'tremebundus' ); ?></p>
							<p style="margin:0 0 var(--space-sm);"><a href="mailto:tremebundusoficial@gmail.com"><?php _e( 'tremebundusoficial@gmail.com', 'tremebundus' ); ?></a></p>
						</div>
						<div class="contact-item">
							<p class="contact-item-label" style="font-family:var(--font-mono);font-size:var(--type-xs);color:var(--color-accent);margin:0 0 var(--space-xs);"><?php _e( 'Sígueme en', 'tremebundus' ); ?></p>
							<ul class="social-links" style="margin:0;">
								<li><a href="https://www.instagram.com/tremebundus_/" target="_blank" rel="noopener"><?php _e( 'Instagram de Tremebundus', 'tremebundus' ); ?></a></li>
								<li><a href="https://www.youtube.com/@Tremebundus13" target="_blank" rel="noopener"><?php _e( 'YouTube de Tremebundus', 'tremebundus' ); ?></a></li>
							</ul>
						</div>
					</div>

					<form class="contact-form" id="tremebundus-contact-form" novalidate>
						<div id="contact-form-message" role="alert" aria-live="polite" aria-atomic="true" style="margin-bottom:var(--space-md);"></div>
						<label for="contact-name"><?php _e( 'Nombre', 'tremebundus' ); ?></label>
						<input type="text" id="contact-name" name="name" required autocomplete="name" minlength="2" maxlength="100">

						<label for="contact-email"><?php _e( 'Email', 'tremebundus' ); ?></label>
						<input type="email" id="contact-email" name="email" required autocomplete="email">

						<label for="contact-interest"><?php _e( 'Me interesa la obra:', 'tremebundus' ); ?></label>
						<select id="contact-interest" name="interest">
							<option value=""><?php _e( 'Selecciona una opción', 'tremebundus' ); ?></option>
							<option value="pintura"><?php _e( 'Pintura al óleo', 'tremebundus' ); ?></option>
							<option value="dibujo"><?php _e( 'Dibujo y tinta', 'tremebundus' ); ?></option>
							<option value="cortometraje"><?php _e( 'Cortometraje / stop motion', 'tremebundus' ); ?></option>
							<option value="poesia"><?php _e( 'Poesía', 'tremebundus' ); ?></option>
							<option value="otro"><?php _e( 'Otro / información general', 'tremebundus' ); ?></option>
						</select>

						<label for="contact-message"><?php _e( 'Mensaje', 'tremebundus' ); ?></label>
						<textarea id="contact-message" name="message" required autocomplete="off"></textarea>

						<button type="button" class="button" id="contact-form-submit"><?php _e( 'Enviar mensaje', 'tremebundus' ); ?></button>
					</form>
					<?php
				else :
					the_content();
				endif;
				?>
			</div><!-- .entry-content -->
		</article><!-- #post -->

		<?php endwhile; // end of the loop. ?>
	</div><!-- .main-content -->
</main><!-- #primary -->

<?php get_footer(); ?>