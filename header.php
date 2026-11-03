<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Skip link for keyboard navigation -->
<a class="skip-link" href="#content"><?php _e( 'Skip to content', 'tremebundus' ); ?></a>

<header id="masthead" class="site-header">
	<div class="site-container">
		<div class="site-branding">
			<?php
			// Site title as script logo, linked to home.
			$home_url = esc_url( home_url( '/' ) );
			$site_name = get_bloginfo( 'name' );
			?>
			<a class="site-title" href="<?php echo $home_url; ?>"><?php echo esc_html( $site_name ); ?></a>
			<p class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
		</div><!-- .site-branding -->

		<!-- Mobile menu toggle -->
		<button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu" aria-label="<?php esc_attr_e( 'Open menu', 'tremebundus' ); ?>">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</button>

		<?php
		// Primary navigation.
		wp_nav_menu( [
			'theme_location' => 'primary',
			'menu_class'     => 'main-nav',
			'container'      => '',
			'items_wrap'     => '<ul id="primary-menu" class="%1$s">%3$s</ul>',
		] );
		?>

		<!-- Cart icon -->
		<a class="cart-link" href="<?php echo esc_url( home_url( '/carrito' ) ); ?>" aria-label="<?php esc_attr_e( 'Cart', 'tremebundus' ); ?>">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<circle cx="9" cy="21" r="1"></circle>
				<circle cx="20" cy="21" r="1"></circle>
				<path d="M1 1h4l2.69 11.39a2 2 0 0 0 1.95 1.61l.23.17a2 2 0 0 0 1.61.95l.17.23a2 2 0 0 0 1.61 1.61l.23.17a2 2 0 0 0 1.95 1.61l.17.23a2 2 0 0 0 1.61 1.61l.23.17a2 2 0 0 0 1.95 1.61L23 21l-3-6.5L16 2l-1-1L7.5 1.5l-1.08-1.08L2 7z"></path>
			</svg>
		</a>

		<!-- Search form -->
		<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
				<span class="visually-hidden"><?php _e( 'Search', 'tremebundus' ); ?></span>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'tremebundus' ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
			</label>
			<button type="submit" class="search-submit"><?php _e( 'Search', 'tremebundus' ); ?></button>
		</form>
	</div><!-- .site-container -->
</header><!-- #masthead -->
