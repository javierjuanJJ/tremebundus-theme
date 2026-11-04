/**
 * animations.js
 * ------------------------------------------------------------
 * Tremebundus — stop-motion style motion with GSAP (free plugins only).
 *
 * Principles:
 *   - Movement "a saltos" (stepped), like stop motion.
 *   - Only animate transform, opacity, clip-path.
 *   - Respect prefers-reduced-motion: content visible, no transforms.
 *   - Never hide content with JS before GSAP loads (fallback-first).
 *   - One orchestrated page-load reveal; the rest are scroll reveals.
 *   - Loaded with defer; only runs where elements exist.
 */

( function() {
	"use strict";

	var reduced = window.tremebundusReducedMotion || false;

	if ( typeof gsap === "undefined" ) {
		return;
	}

	gsap.registerPlugin( ScrollTrigger, Flip );

	// ------------------------------------------------------------------
	// Helper gratuito que reemplaza GSAP SplitText (plugin de pago).
	// Divide el texto de un elemento en <span> por carácter, listo
	// para animar con stagger. Devuelve el array de spans.
	// ------------------------------------------------------------------
	function splitChars( el ) {
		var text = el.textContent;
		el.innerHTML = '';
		var chars = [];
		for ( var i = 0; i < text.length; i++ ) {
			var ch = document.createElement( 'span' );
			ch.className = 'char';
			// Preserva los espacios visibles en lugar de colapsarlos.
			ch.textContent = text[i] === ' ' ? '\u00A0' : text[i];
			el.appendChild( ch );
			chars.push( ch );
		}
		return chars;
	}

	var mm = gsap.matchMedia();

	// ------------------------------------------------------------------
	// 1. No reduced motion: orchestrated reveals.
	// ------------------------------------------------------------------
	mm.add( "(prefers-reduced-motion: no-preference)", function() {

		// --- Hero title: letters appear "a 12 fps" (steps easing) ---
		var heroTitle = document.querySelector( ".home-hero-name" );
		if ( heroTitle ) {
			gsap.set( heroTitle, { opacity: 1, visibility: "visible" } );
			var chars = splitChars( heroTitle );
			gsap.from( chars, {
				opacity: 0,
				y: 20,
				rotate: function() { return gsap.utils.random( -6, 6 ); },
				duration: 0.9,
				stagger: 0.04,
				ease: "steps(6)",
				delay: 0.2
			} );
		}

		// --- Hero image: gentle parallax on scroll ---
		var heroImg = document.querySelector( ".home-hero-image" );
		if ( heroImg ) {
			gsap.to( heroImg, {
				yPercent: 10,
				ease: "none",
				scrollTrigger: {
					trigger: ".home-hero",
					start: "top bottom",
					end: "bottom top",
					scrub: true
				}
			} );
		}

		// --- Section reveals: fade up on scroll (one orchestrated reveal per section) ---
		document.querySelectorAll( ".section-heading, .cortometraje-item, .contacto, .home-what-youll-find" ).forEach( function( el ) {
			gsap.from( el, {
				opacity: 0,
				y: 30,
				duration: 0.8,
				ease: "power2.out",
				scrollTrigger: {
					trigger: el,
					start: "top 85%",
					once: true
				}
			} );
		} );

		// --- Obra cards: staggered clip-path reveal on scroll ---
		document.querySelectorAll( ".obra-card img" ).forEach( function( img ) {
			gsap.fromTo( img,
				{ clipPath: "inset(100% 0 0 0)", scale: 1.1 },
				{
					clipPath: "inset(0% 0 0 0)",
					scale: 1,
					duration: 1.2,
					ease: "power3.out",
					scrollTrigger: {
						trigger: img,
						start: "top 85%",
						once: true
					}
				}
			);
		} );

		// --- Obra card lift on hover (GSAP, not a CSS transition on every card) ---
		document.querySelectorAll( ".obra-card" ).forEach( function( card ) {
			card.addEventListener( "mouseenter", function() {
				gsap.to( card, { y: -6, scale: 1.02, duration: 0.3, ease: "power2.out" } );
			} );
			card.addEventListener( "mouseleave", function() {
				gsap.to( card, { y: 0, scale: 1, duration: 0.3, ease: "power2.out" } );
			} );
		} );

		// --- Poemas: line-by-line reveal, like typing ---
		document.querySelectorAll( ".poema" ).forEach( function( poema ) {
			// Only animate if not already split.
			if ( poema.classList.contains( "poema-animated" ) ) {
				return;
			}
			var lines = poema.querySelectorAll( "p" );
			if ( lines.length === 0 ) {
				return;
			}
			gsap.from( lines, {
				yPercent: 10,
				opacity: 0,
				stagger: 0.12,
				duration: 0.6,
				ease: "power2.out",
				scrollTrigger: {
					trigger: poema,
					start: "top 85%",
					once: true
				}
			} );
			poema.classList.add( "poema-animated" );
		} );

	} );

	// ------------------------------------------------------------------
	// 2. Reduced motion: everything visible, no transforms.
	// ------------------------------------------------------------------
	mm.add( "(prefers-reduced-motion: reduce)", function() {
		gsap.set(
			[
				".home-hero-name",
				".obra-card img",
				".poema p",
				".section-heading",
				".cortometraje-item",
				".contacto",
				".home-what-youll-find"
			],
			{ clearProps: "all" }
		);
		ScrollTrigger.getAll().forEach( function( st ) { st.kill(); } );
	} );

} )();
