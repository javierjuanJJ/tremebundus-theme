<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/php/html/401">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Skip link for keyboard navigation -->
<a class="skip-link" href="#content"><?php _e( 'Skip to content', 'tremebundus' ); ?></a>

<header id="masthead" class="site-header">
	<div class="site-branding">
		<?php
		the_custom_logo();

		// Navigation menu
		wp_nav_menu( [
			'theme_location' => 'primary',
			'menu_class' => 'main-nav',
			'container' => '',
		] );
		?>
	</div>

	<!-- Accessible search form -->
	<form class="search-form" role="search" method="get" action="<? echo esc_url( home_url( '/' ) ); ?>">
		<label>
			<span class="visually-hidden"><?php _e( 'Search', 'tremebundus' ); ?></span>
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'tremebundus' ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
		</label>
		<button type="submit" class="search-submit"><?php _e( 'Search', 'tremebundus' ); ?></button>
	</form>
</header><!-- #masthead -->