/**
 * navigation.js
 * ------------------------------------------------------------
 * Responsive navigation toggles with open/close animations.
 *
 * Accessibility:
 *   - Toggles aria-expanded on the button.
 *   - Provides a keyboard-operable control for mobile submenus.
 *   - Closes the mobile menu with ESC, outside clicks, or link selection.
 */

( function() {
	var toggle = document.querySelector( '.menu-toggle' );
	var nav    = document.querySelector( '.main-nav' );
	var html   = document.documentElement;
	var mobile = window.matchMedia( '(max-width: 781px)' );

	if ( ! toggle || ! nav ) {
		return;
	}

	var submenuToggles = [];

	nav.querySelectorAll( '.menu-item-has-children' ).forEach( function( item, index ) {
		var link = item.querySelector( ':scope > a' );
		var submenu = item.querySelector( ':scope > .sub-menu' );

		if ( ! link || ! submenu ) {
			return;
		}

		if ( ! submenu.id ) {
			submenu.id = 'primary-submenu-' + ( index + 1 );
		}

		var submenuToggle = document.createElement( 'button' );
		submenuToggle.type = 'button';
		submenuToggle.className = 'submenu-toggle';
		submenuToggle.setAttribute( 'aria-expanded', 'false' );
		submenuToggle.setAttribute( 'aria-controls', submenu.id );
		submenuToggle.setAttribute( 'aria-label', 'Mostrar submenú: ' + link.textContent.trim() );
		link.insertAdjacentElement( 'afterend', submenuToggle );
		submenuToggles.push( submenuToggle );

		submenuToggle.addEventListener( 'click', function() {
			var expanded = submenuToggle.getAttribute( 'aria-expanded' ) === 'true';
			submenuToggle.setAttribute( 'aria-expanded', String( ! expanded ) );
			submenuToggle.setAttribute(
				'aria-label',
				( expanded ? 'Mostrar submenú: ' : 'Ocultar submenú: ' ) + link.textContent.trim()
			);
			item.classList.toggle( 'submenu-open', ! expanded );
		} );
	} );

	function openMenu() {
		toggle.setAttribute( 'aria-expanded', 'true' );
		nav.classList.add( 'open' );
		html.classList.add( 'menu-open' );

		var firstLink = nav.querySelector( 'a' );
		if ( firstLink ) {
			firstLink.focus();
		}
	}

	function closeMenu( restoreFocus ) {
		toggle.setAttribute( 'aria-expanded', 'false' );
		nav.classList.remove( 'open' );
		html.classList.remove( 'menu-open' );
		submenuToggles.forEach( function( submenuToggle ) {
			submenuToggle.setAttribute( 'aria-expanded', 'false' );
			submenuToggle.parentElement.classList.remove( 'submenu-open' );
			submenuToggle.setAttribute(
				'aria-label',
				'Mostrar submenú: ' + submenuToggle.parentElement.querySelector( ':scope > a' ).textContent.trim()
			);
		} );

		if ( restoreFocus ) {
			toggle.focus();
		}
	}

	toggle.addEventListener( 'click', function() {
		var expanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
		if ( expanded ) {
			closeMenu( true );
		} else {
			openMenu();
		}
	} );

	nav.querySelectorAll( 'a' ).forEach( function( link ) {
		link.addEventListener( 'click', function() {
			if ( mobile.matches ) {
				closeMenu( false );
			}
		} );
	} );

	document.addEventListener( 'keydown', function( event ) {
		if ( event.key !== 'Escape' ) {
			return;
		}

		var activeSubmenu = document.activeElement.closest ?
			document.activeElement.closest( '.sub-menu' ) : null;
		var activeSubmenuToggle = submenuToggles.find( function( submenuToggle ) {
			return activeSubmenu &&
				submenuToggle.getAttribute( 'aria-expanded' ) === 'true' &&
				submenuToggle.getAttribute( 'aria-controls' ) === activeSubmenu.id;
		} );

		if ( activeSubmenuToggle ) {
			activeSubmenuToggle.click();
			activeSubmenuToggle.focus();
			return;
		}

		if ( nav.classList.contains( 'open' ) ) {
			closeMenu( true );
		}
	} );

	document.addEventListener( 'click', function( event ) {
		if ( ! mobile.matches || ! nav.classList.contains( 'open' ) ) {
			return;
		}
		if ( nav.contains( event.target ) || toggle.contains( event.target ) ) {
			return;
		}
		closeMenu( false );
	} );

	window.addEventListener( 'resize', function() {
		if ( ! mobile.matches && nav.classList.contains( 'open' ) ) {
			closeMenu( false );
		}
	} );
} )();
