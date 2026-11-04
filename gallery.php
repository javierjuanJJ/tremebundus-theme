<?php
/**
 * Template Name: Galería
 * Template Post Type: page
 * ------------------------------------------------------------
 * Galería de obras: rejilla asimétrica tipo masonry con hover que
 * revela título y precio. Enlace a la ficha de cada obra.
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

				<section class="gallery-grid" id="gallery-grid">
					<?php
					// Example: loop through a custom post type 'obra' or attachments.
					// Here we render placeholder cards; replace with real obra query.
					$obras = array(
						array(
							'title' => 'Naturaleza muerta con flores',
							'tecnica' => 'Óleo sobre lienzo',
							'medidas' => '40 × 50 cm',
							'precio' => '650 €',
							'estado' => 'disponible',
							'image' => get_theme_file_uri( 'img/Cortometrajes--11-03-2026_02_20_PM.png' ),
							'alt' => 'Óleo sobre lienzo — flores rojas y amarillas sobre fondo oscuro',
						),
						array(
							'title' => 'Autorretrato en tinta',
							'tecnica' => 'Tinta sobre papel',
							'medidas' => '30 × 40 cm',
							'precio' => '320 €',
							'estado' => 'disponible',
							'image' => get_theme_file_uri( 'img/Bio--11-03-2026_02_22_PM.png' ),
							'alt' => 'Retrato a tinta — rostro en blanco y negro',
						),
						array(
							'title' => 'Naturaleza muerta vendida',
							'tecnica' => 'Óleo sobre tabla',
							'medidas' => '50 × 60 cm',
							'precio' => '—',
							'estado' => 'vendido',
							'image' => get_theme_file_uri( 'img/Poemas--11-03-2026_02_21_PM.png' ),
							'alt' => 'Óleo sobre tabla — composición de objetos',
						),
					);

					foreach ( $obras as $obra ) :
						?>
						<article class="obra-card">
							<img src="<?php echo esc_url( $obra['image'] ); ?>" alt="<?php echo esc_attr( $obra['alt'] ); ?>" loading="lazy">
							<div class="obra-card-info">
								<h3 class="obra-card-title"><?php echo esc_html( $obra['title'] ); ?></h3>
								<p class="obra-card-price">
									<?php echo esc_html( $obra['precio'] ); ?>
								</p>
								<p style="font-family:var(--font-mono);font-size:var(--type-xs);color:var(--color-text-muted);margin:0;">
									<?php echo esc_html( $obra['tecnica'] ); ?> · <?php echo esc_html( $obra['medidas'] ); ?>
								</p>
							</div>
						</article>
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