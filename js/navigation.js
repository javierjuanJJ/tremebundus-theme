/**
 * navigation.js
 * ------------------------------------------------------------
 * Mobile menu toggle for the hamburger button.
 * Accessibility: toggles aria-expanded and manages focus.
 */

( function() {
	var toggle = document.querySelector( '.menu-toggle' );
	var nav    = document.querySelector( '.main-nav' );

	if ( ! toggle || ! nav ) {
		return;
	}

	toggle.addEventListener( 'click', function() {
		var expanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
		toggle.setAttribute( 'aria-expanded', ! expanded );
		nav.classList.toggle( 'open' );
	} );

	// Close menu when a link is clicked (mobile).
	var links = nav.querySelectorAll( 'a' );
	links.forEach( function( link ) {
		link.addEventListener( 'click', function() {
			toggle.setAttribute( 'aria-expanded', 'false' );
			nav.classList.remove( 'open' );
		} );
	} );
} )();
