<?php
/**
 * Main template
 * ------------------------------------------------------------
 * Displays the site homepage or front page.
 */

get_header(); ?>

<main id="primary" class="content-area">
	<div class="main-content site-container">

		<?php
		// Show posts if available.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content">
				<?php
				// Featured image as full-screen hero (like reference home image).
				if ( has_post_thumbnail() ) :
					echo '<div class="home-hero">';
					echo '<img class="home-hero-image" src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) . '" alt="' . esc_attr( get_the_post_thumbnail_caption( get_the_ID() ) || get_the_title() ) . '" width="' . esc_attr( get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_width', true ) ?: '1200' ) . '" height="' . esc_attr( get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_height', true ) ?: '800' ) . '" loading="lazy">';
					echo '<div class="home-hero-content">';
					// Page title as h1 — one per page, overlaid on hero.
					the_title( '<h1 class="entry-title home-hero-name">', '</h1>' );
					?>
					<p class="home-hero-subtitle"><?php _e( 'Galería de arte, cortometrajes y poesías de Daniel Milán.', 'tremebundus' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/galeria' ) ); ?>" class="button home-hero-cta"><?php _e( 'Ver galería', 'tremebundus' ); ?></a>
					<?php
					echo '</div>';
					echo '</div>';
				endif;

				// The content.
				the_content();
				?>
			</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?>-->

		<?php
			endwhile;
		endif;
		?>

		<?php
		// Home-specific "Qué encontrarán aquí" section when on front page.
		if ( is_front_page() && is_home() ) :
		?>
		<section class="home-what-youll-find">
			<h2 class="section-heading"><?php _e( 'Qué encontrarán aquí', 'tremebundus' ); ?></h2>
			<p><?php _e( 'A lo largo de toda mi vida he dedicado mucho tiempo a crecer mi particular mundo interior. Ahora, gracias a este espacio, puedo compartirlo con todos vosotros. Seguidme en redes para más contenido.', 'tremebundus' ); ?></p>
			<h3 class="script-heading-sm"><?php _e( 'Pintura, Dibujo, Poesía y Cine', 'tremebundus' ); ?></h3>
			<ul>
				<li><?php _e( 'Pinturas en Óleo. Dibujos a linta y otras técnicas.', 'tremebundus' ); ?></li>
				<li><?php _e( 'Poesías y otros escritos.', 'tremebundus' ); ?></li>
				<li><?php _e( 'Animación Stop Motion.', 'tremebundus' ); ?></li>
				<li><?php _e( 'Cortometrajes de terror y fantasía con banda sonora original.', 'tremebundus' ); ?></li>
			</ul>
		</section>
		<?php endif; ?>

	</div><!-- .main-content -->
</main><!-- #primary -->

<?php
get_footer();