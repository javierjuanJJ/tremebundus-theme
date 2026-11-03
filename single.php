<?php
/**
 * Single post template
 * ------------------------------------------------------------
 * Displays a single post (e.g. Bio page).
 */

get_header(); ?>

<main id="primary" class="content-area">
	<div class="main-content site-container">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-header">
				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				tremebundus_posted_on();
				?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php
				// Featured image: portrait on the left side (bio style).
				if ( has_post_thumbnail() ) :
					echo '<div class="bio-portrait">';
					the_post_thumbnail( 'medium', [ 'alt' => get_the_post_thumbnail_caption( get_post()->ID ) || get_the_title() ] );
					echo '</div>';
				endif;

				// The content.
				the_content();

				// Edit link.
				edit_post_link(
					sprintf(
					/* translators: %s: Edit link */
						__( 'Edit %s', 'tremebundus' ),
						the_title_attribute( [ 'echo' => false ] )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</div><!-- .entry-content -->
		</article><!-- #post -->
	</div><!-- .main-content -->
</main><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>