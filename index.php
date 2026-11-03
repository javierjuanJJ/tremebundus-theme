<?php
/**
 * Main template
 * ------------------------------------------------------------
 * Displays the site homepage or front page.
 */

get_header(); ?>

<main id="primary" class="content-area">
	<div class="main-content">

		<?php
		// Show posts if available.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-header">
				<?php
				// Post title as heading.
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				// Entry meta.
				tremebundus_posted_on();
				?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php
				// Featured image (if singular).
				if ( is_singular() && has_post_thumbnail() ) :
					the_post_thumbnail( 'full', [ 'alt' => get_the_title() ] );
				endif;

				// The content.
				the_content();

				// Link to previous/next post.
				the_post_navigation( [
					'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous:', 'tremebundus' ) . '</span> <span class="meta-nav">←</span> %s',
					'next_text' => '%s <span class="screen-reader-text">' . esc_html__( 'Next:', 'tremebundus' ) . '</span> <span class="meta-nav">→</span>',
				] );
				?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?>-->

		<?php
			endwhile;
		endif;
		?>

	</div><!-- .main-content -->
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();