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

			<?php
			// Page title as h1 (centered serif white, like reference images).
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>

			<div class="entry-content">
				<?php
				// Featured image (full width, like reference home image).
				if ( has_post_thumbnail() ) :
					echo '<div class="home-featured-image">';
					the_post_thumbnail( 'full', [ 'alt' => get_the_title() ] );
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
			<h2 class="script-heading"><?php _e( 'Qué encontrarán aquí', 'tremebundus' ); ?></h2>
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
get_sidebar();
get_footer();