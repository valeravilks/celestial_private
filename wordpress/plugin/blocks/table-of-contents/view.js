/** Enhance native anchor links; navigation remains usable without JavaScript. */
function initTableOfContents() {
	const navigations = Array.from(
		document.querySelectorAll( '.wp-block-celestial-table-of-contents' )
	).map( ( nav ) => ( {
		nav,
		items: Array.from( nav.querySelectorAll( 'a[href^="#"]' ) )
			.map( ( link ) => {
				let id;
				try {
					id = decodeURIComponent( link.hash.slice( 1 ) );
				} catch {
					return null;
				}
				const heading = document.getElementById( id );
				return heading ? { link, heading } : null;
			} )
			.filter( Boolean ),
	} ) ).filter( ( entry ) => entry.items.length );
	if ( ! navigations.length ) return;

	function update() {
		for ( const { nav, items } of navigations ) {
			const toolbar = document.getElementById( 'wpadminbar' );
			const toolbarBottom = toolbar?.getBoundingClientRect().bottom || 0;
			const anchorMargin = parseFloat( getComputedStyle( items[ 0 ].heading ).scrollMarginTop ) || 0;
			const scrollPadding = parseFloat( getComputedStyle( document.documentElement ).scrollPaddingTop ) || 0;
			const line = Math.max( Math.max( 0, toolbarBottom ) + 48, anchorMargin + scrollPadding + 4 );
			let active = items[ 0 ];
			for ( const item of items ) {
				if ( item.heading.getBoundingClientRect().top <= line ) {
					active = item;
				}
			}
			if ( window.scrollY > 0 && window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 2 ) {
				active = items[ items.length - 1 ];
			}
			const previous = nav.querySelector( '[aria-current="location"]' );
			if ( previous === active.link ) continue;
			previous?.removeAttribute( 'aria-current' );
			active.link.setAttribute( 'aria-current', 'location' );
			// Scroll only the navigation's own overflow area, never the page.
			if ( getComputedStyle( nav ).position === 'sticky' ) {
				const bounds = nav.getBoundingClientRect();
				const linkBounds = active.link.getBoundingClientRect();
				if ( linkBounds.top < bounds.top ) nav.scrollTop -= bounds.top - linkBounds.top;
				if ( linkBounds.bottom > bounds.bottom ) nav.scrollTop += linkBounds.bottom - bounds.bottom;
			}
		}
	}
	let pending = false;
	function schedule() {
		if ( pending ) return;
		pending = true;
		requestAnimationFrame( () => {
			pending = false;
			update();
		} );
	}
	window.addEventListener( 'scroll', schedule, { passive: true } );
	window.addEventListener( 'resize', schedule );
	window.addEventListener( 'hashchange', schedule );
	window.addEventListener( 'load', schedule );
	document.fonts?.ready.then( schedule );
	schedule();
}
if ( document.readyState === 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', initTableOfContents, { once: true } );
} else {
	initTableOfContents();
}
