<?php
/**
 * Page template
 * ------------------------------------------------------------
 * Displays a static page.
 */

get_header(); ?>

<main id="primary" class="content-area">
	<div class="main-content">

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-header">
				<?php
				// Page title.
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post -->

		<?php endwhile; // end of the loop. ?>
	</div><!-- .main-content -->
</main><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>