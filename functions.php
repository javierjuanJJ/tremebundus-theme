<?php
/**
 * Theme functions
 * ------------------------------------------------------------
 * Theme setup, enqueues, navigation menus, mobile menu, contact form.
 */



/**
 * Display post date and author.
 */
function tremebundus_posted_on() {
	printf( '<span class="posted-on"><a href="%1$s" rel="bookmark"><span class="screen-reader-text">%2$s</span> %3$s</a></span>',
		esc_url( get_permalink() ),
		esc_html__( 'Published', 'tremebundus' ),
		get_the_date()
	);
}

// Add theme support features.
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
register_nav_menus( [
	'primary' => esc_html__( 'Primary Menu', 'tremebundus' ),
] );

/**
 * Enqueue styles and scripts.
 */
function tremebundus_enqueue_assets() {
	// Core stylesheet.
	wp_enqueue_style(
		'tremebundus-style',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme()->get( 'Version' )
	);

	// Google Fonts: Cormorant Garamond (serif headings + poems), Inter (sans UI),
	// Great Vibes (script logo only), JetBrains Mono (mono credits).
	wp_enqueue_style(
		'tremebundus-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Great+Vibes&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap',
		[],
		null
	);

	if ( is_admin() ) {
		return;
	}

	// Mobile menu toggle script.
	wp_enqueue_script(
		'tremebundus-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);

	// GSAP + plugins libres (ScrollTrigger, Flip). SplitText es un plugin de
	// pago de GSAP (no disponible gratis en cdnjs); se reemplaza por una
	// división de caracteres ligera en js/animations.js.
	wp_enqueue_script(
		'gsap-core',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
		[],
		'3.12.5',
		true
	);
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
		[ 'gsap-core' ],
		'3.12.5',
		true
	);
	wp_enqueue_script(
		'gsap-flip',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Flip.min.js',
		[ 'gsap-core' ],
		'3.12.5',
		true
	);

	// Theme GSAP animations (stop-motion style).
	wp_enqueue_script(
		'tremebundus-animations',
		get_template_directory_uri() . '/js/animations.js',
		[ 'gsap-core', 'gsap-scrolltrigger', 'gsap-flip' ],
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Pass reduced-motion preference to JS.
	wp_add_inline_script(
		'tremebundus-animations',
		'window.tremebundusReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;'
	);
}
add_action( 'wp_enqueue_scripts', 'tremebundus_enqueue_assets' );

/**
 * Contact form handler via AJAX.
 */
function tremebundus_contact_form() {
	check_ajax_referer( 'tremebundus-contact', 'security' );

	$name    = sanitize_text_field( $_POST['name'] ?? '' );
	$email   = sanitize_email( $_POST['email'] ?? '' );
	$message = sanitize_textarea_field( $_POST['message'] ?? '' );
	$interest = sanitize_text_field( $_POST['interest'] ?? '' );

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( [ 'message' => __( 'Por favor, rellena nombre, email y mensaje.', 'tremebundus' ) ] );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( [ 'message' => __( 'Introduce un email válido.', 'tremebundus' ) ] );
	}

	$to      = get_bloginfo( 'admin_email' );
	$subject = sprintf( __( 'Nuevo mensaje de contacto de %s — Tremebundus', 'tremebundus' ), $name );
	$body    = sprintf(
		__(
			"Nombre: %1$s\nEmail: %2$s\nInterés: %3$s\n\nMensaje:\n%4$s",
			'tremebundus'
		),
		$name,
		$email,
		$interest,
		$message
	);
	$headers = [ 'From: ' . $name . ' <' . $email . '>' ];

	if ( wp_mail( $to, $subject, $body, $headers ) ) {
		wp_send_json_success( [ 'message' => __( 'Mensaje enviado. Gracias.', 'tremebundus' ) ] );
	}

	wp_send_json_error( [ 'message' => __( 'No se pudo enviar el mensaje. Inténtalo de nuevo.', 'tremebundus' ) ] );
}
add_action( 'wp_ajax_tremebundus_contact', 'tremebundus_contact_form' );
add_action( 'wp_ajax_nopriv_tremebundus_contact', 'tremebundus_contact_form' );

/**
 * Clean up document titles: remove trailing dashes, ensure "Página | Tremebundus" format.
 */
function tremebundus_document_title_parts( $title ) {
	if ( isset( $title['tagline'] ) && empty( $title['tagline'] ) ) {
		unset( $title['tagline'] );
	}
	// Ensure site name always appears.
	if ( ! isset( $title['site'] ) || empty( $title['site'] ) ) {
		$title['site'] = get_bloginfo( 'name' );
	}
	return $title;
}
add_filter( 'document_title_parts', 'tremebundus_document_title_parts' );

/**
 * Open Graph meta tags for social sharing.
 */
function tremebundus_opengraph() {
	global $post;

	$site_name = get_bloginfo( 'name' );
	$site_url  = home_url();
	$image     = '';

	if ( is_singular() && has_post_thumbnail( $post->ID ) ) {
		$image = get_the_post_thumbnail_url( $post->ID, 'full' );
	}

	?>
	<meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( $_SERVER['REQUEST_URI'] ?? '/' ) ); ?>">
	<meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
	<?php if ( $image ) : ?>
		<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'tremebundus_opengraph', 1 );

/**
 * Output contact form nonce and AJAX handler for the contact page.
 */
function tremebundus_contact_nonce() {
	if ( is_page( 'contacto' ) ) {
		?>
		<script id="tremebundus-contact-js-extra">
			var tremebundusContact = {
				ajaxUrl: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
				nonce:   '<?php echo wp_create_nonce( 'tremebundus-contact' ); ?>'
			};
		</script>
		<script id="tremebundus-contact-form-js">
			( function() {
				var form   = document.getElementById( 'tremebundus-contact-form' );
				var submit = document.getElementById( 'contact-form-submit' );
				var msg    = document.getElementById( 'contact-form-message' );

				if ( ! form || ! submit || ! msg ) {
					return;
				}

				submit.addEventListener( 'click', function( e ) {
					e.preventDefault();

					var name    = document.getElementById( 'contact-name' ).value;
					var email   = document.getElementById( 'contact-email' ).value;
					var message = document.getElementById( 'contact-message' ).value;
					var interest = document.getElementById( 'contact-interest' ).value;

					msg.textContent = '';
					msg.setAttribute( 'role', 'alert' );
					msg.setAttribute( 'aria-live', 'polite' );
					msg.setAttribute( 'aria-atomic', 'true' );

					submit.disabled = true;
					submit.textContent = '<?php _e( 'Enviando…', 'tremebundus' ); ?>';

					fetch( tremebundusContact.ajaxUrl, {
						method: 'POST',
						headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						body: new URLSearchParams( {
							action:    'tremebundus_contact',
							security:  tremebundusContact.nonce,
							name:      name,
							email:     email,
							message:   message,
							interest:  interest
						} )
					} )
					.then( function( response ) { return response.json(); } )
					.then( function( data ) {
						submit.disabled = false;
						submit.textContent = '<?php _e( 'Enviar mensaje', 'tremebundus' ); ?>';

						if ( data.success ) {
							msg.style.color = 'var(--color-text)';
							msg.textContent = data.data.message;
							form.reset();
						} else {
							msg.style.color = 'var(--color-accent)';
							msg.textContent = data.data && data.data.message ? data.data.message : '<?php _e( 'Error al enviar. Inténtalo de nuevo.', 'tremebundus' ); ?>';
						}
					} )
					.catch( function() {
						submit.disabled = false;
						submit.textContent = '<?php _e( 'Enviar mensaje', 'tremebundus' ); ?>';
						msg.style.color = 'var(--color-accent)';
						msg.textContent = '<?php _e( 'Error de conexión. Inténtalo de nuevo.', 'tremebundus' ); ?>';
					} );
				} );
			} )();
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'tremebundus_contact_nonce', 20 );