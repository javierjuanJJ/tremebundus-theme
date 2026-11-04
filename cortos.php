<?php
/**
 * Template Name: Cortometrajes
 * Template Post Type: page
 * ------------------------------------------------------------
 * Cortometrajes: una sección por corto con póster, sinopsis,
 * créditos en mono y reproductor lite (façade YouTube).
 * FANTAELX muestra insignia "Selección oficial 2026".
 */

get_header(); ?>

<main id="primary" class="content-area">
	<div class="main-content site-container">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>

				<section class="cortometraje-collection" id="cortometraje-collection">
					<?php
					$cortos = array(
						array(
							'title' => 'El Ladrón de Cabezas',
							'year' => '(Próximamente)',
							'poster' => get_theme_file_uri( 'img/Cortometrajes--11-03-2026_02_20_PM.png' ),
							'alt' => 'Fotograma del cortometraje El Ladrón de Cabezas — niño con camiseta de rayas',
							'synopsis' => 'Un hombre roba una cabeza para sumarla a su colección, tendra que asumir las consecuencias de su crimen.',
							'credits' => 'Dirección, Animación y Edición: Daniel Milán. Música y Sonido (Caja de Sonido): Daniel Milán.',
							'festival' => 'Selección Oficial del Festival Internacional de Cine Fantástico de Elche (2020) - FANTAELX',
							'youtube' => '',
							'badge' => true,
						),
						array(
							'title' => 'La Mancha',
							'year' => '(2026)',
							'poster' => get_theme_file_uri( 'img/Cortometrajes--11-03-2026_02_20_PM.png' ),
							'alt' => 'Fotograma del cortometraje La Mancha',
							'synopsis' => 'Un hombre encuentra una siniestra mancha detrás de un armario. Cortometraje inspirado en el teatro japonés Kanshaibai.',
							'credits' => 'Dirección, Arte, Animación y Edición: Daniel Milán. Música y Sonido (Caja de Sonido): Daniel Milán.',
							'festival' => '',
							'youtube' => '',
							'badge' => false,
						),
						array(
							'title' => 'Equinoccio',
							'year' => '(2025)',
							'poster' => get_theme_file_uri( 'img/Cortometrajes--11-03-2026_02_20_PM.png' ),
							'alt' => 'Fotograma del cortometraje Equinoccio',
							'synopsis' => 'Primer cortometraje animado stop motion. Sobre las emociones descontroladas y lo que son capaces de hacer por satisfacerse.',
							'credits' => 'Dirección, Animación y Edición: Daniel Milán. Música y Sonido (No-Input Mixing): Daniel Milán.',
							'festival' => '',
							'youtube' => '',
							'badge' => false,
						),
						array(
							'title' => 'Via Finalis',
							'year' => '(2025)',
							'poster' => get_theme_file_uri( 'img/Cortometrajes--11-03-2026_02_20_PM.png' ),
							'alt' => 'Fotograma del cortometraje Via Finalis',
							'synopsis' => 'El Camino Final. Último trayecto que recorre el ánima desde el momento que abandona el cuerpo hasta alcanzar la luz.',
							'credits' => 'Música y Sonido (Behringer K2 MKII): Daniel Milán. Dirección, Animación y Edición: Daniel Milán. Alcocé, Alcoy, Alicante.',
							'festival' => '',
							'youtube' => '',
							'badge' => false,
						),
					);

					foreach ( $cortos as $corto ) :
						?>
						<div class="cortometraje-item">
							<div class="cortometraje-header" style="display:flex;flex-direction:column;gap:var(--space-sm);align-items:flex-start;">
								<h2 class="cortometraje-title">
									<?php echo esc_html( $corto['title'] ); ?>
									<?php if ( $corto['badge'] ) : ?>
										<span class="cortometraje-badge"><?php _e( 'Selección oficial 2026 — FANTAELX', 'tremebundus' ); ?></span>
									<?php endif; ?>
									<span class="cortometraje-year"><?php echo esc_html( $corto['year'] ); ?></span>
								</h2>
							</div>

							<div class="short-video">
								<?php if ( ! empty( $corto['youtube'] ) ) : ?>
									<iframe src="<?php echo esc_url( $corto['youtube'] ); ?>" title="<?php echo esc_attr( $corto['title'] ); ?>" loading="lazy"></iframe>
								<?php else : ?>
									<img src="<?php echo esc_url( $corto['poster'] ); ?>" alt="<?php echo esc_attr( $corto['alt'] ); ?>" loading="lazy" style="width:100%;height:auto;display:block;max-height:500px;object-fit:cover;">
									<p style="font-family:var(--font-sans);font-size:var(--type-sm);color:var(--color-text-muted);margin-top:var(--space-xs);"><?php _e( 'Vídeo disponible en el canal de YouTube de Tremebundus.', 'tremebundus' ); ?></p>
								<?php endif; ?>
							</div>

							<p class="cortometraje-synopsis"><?php echo esc_html( $corto['synopsis'] ); ?></p>

							<div class="cortometraje-details">
								<ul>
									<li><?php echo esc_html( $corto['credits'] ); ?></li>
								</ul>
							</div>

							<?php if ( ! empty( $corto['festival'] ) ) : ?>
								<p style="font-family:var(--font-serif);font-size:var(--type-sm);color:var(--color-accent);margin:var(--space-md) 0 0;font-style:italic;"><?php echo esc_html( $corto['festival'] ); ?></p>
							<?php endif; ?>

							<div style="text-align:center;color:var(--color-text-muted);font-size:var(--type-xs);letter-spacing:0.5em;margin:var(--space-md) 0;">···</div>
						</div>
						<?php
					endforeach;
					?>
				</section>

			</div><!-- .entry-content -->
		</article><!-- #post -->
	</div><!-- .main-content -->
</main><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>