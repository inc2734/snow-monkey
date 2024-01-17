import { getFooterStickyNav, hide, show, throttle, getStyle, isPassiveSupported } from './module/_helper';

document.addEventListener(
	'DOMContentLoaded',
	() => {
		const pageTop = document.getElementById( 'page-top' );
		if ( ! pageTop ) {
			return;
		}

		let ariaHidden = pageTop.getAttribute( 'aria-hidden' );

		const handleScroll = throttle( () => {
			if ( 500 <= window.scrollY ) {
				if ( 'false' !== ariaHidden ) {
					show( pageTop );
					ariaHidden = 'false';
				}
			} else {
				if ( 'true' !== ariaHidden ) {
					hide( pageTop );
					ariaHidden = 'true';
				}
			}
		}, 150 );

		window.addEventListener( 'scroll', handleScroll, isPassiveSupported() ? { passive: true } : false );

		const footerStickyNav = getFooterStickyNav();
		if ( ! footerStickyNav ) {
			return;
		}

		const resizeObserver = new ResizeObserver( () => {
			pageTop.style.setProperty( '--page-top-y', `${ footerStickyNav.offsetHeight - parseInt( getStyle( pageTop, '--safe-area-inset-bottom' ) ) }px` );
		} );
		resizeObserver.observe( footerStickyNav );
	},
	false
);
