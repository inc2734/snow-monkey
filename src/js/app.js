import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

import { scrollChecker } from './module/_scroll-checker';

import { getHeader, getDropNavWrapper, getHtml, getStyle, getTargetOffsetTop, maybeLeftHeaderLayout } from './module/_helper';

document.addEventListener(
	'DOMContentLoaded',
	() => {
		const html = getHtml();
		scrollChecker( html );

		const hash = window.location.hash;
		if ( ! hash || '#body' === hash ) {
			return;
		}

		const header = getHeader();
		if ( ! header ) {
			return;
		}

		if ( header.offsetWidth < html.offsetWidth ) {
			return;
		}

		const maxRetryCount = 20;
		let retryCount = 0;

		const showHeaderWithScroll = () => {
			window.removeEventListener( 'scroll', showHeaderWithScroll, false );
			header.removeAttribute( 'aria-hidden' );
		};

		const hideHeaderWithLocationHash = () => {
			const pageYOffset = Math.floor( window.pageYOffset ) + parseFloat( getStyle( getHtml(), 'margin-top' ) ) ?? 0;
			if ( ! pageYOffset && ++retryCount < maxRetryCount ) {
				requestAnimationFrame( hideHeaderWithLocationHash );
			}

			const dropNav = getDropNavWrapper();
			const headerCssPosition = getStyle( header, 'position' );
			const isNormalHeaderPosition = 'absolute' !== headerCssPosition && 'sticky' !== headerCssPosition && 'fixed' !== headerCssPosition && ! dropNav;

			if ( isNormalHeaderPosition ) {
				window.removeEventListener( 'scroll', hideHeaderWithLocationHash, false );
				header.removeAttribute( 'aria-hidden' );
				return;
			}

			header.setAttribute( 'aria-hidden', 'true' );

			let targetOffsetTop = getTargetOffsetTop();
			if ( false !== targetOffsetTop ) {
				targetOffsetTop = Math.floor( targetOffsetTop );
				const headerOffsetBottom = Math.floor( header.getBoundingClientRect().top + header.offsetHeight );
				if ( targetOffsetTop < headerOffsetBottom ) {
					return;
				}
			}

			if ( 25 > Math.abs( targetOffsetTop - pageYOffset ) ) {
				return;
			}

			window.removeEventListener( 'scroll', hideHeaderWithLocationHash, false );

			requestAnimationFrame( () => window.addEventListener( 'scroll', showHeaderWithScroll, false ) );
		};

		window.addEventListener( 'scroll', hideHeaderWithLocationHash, false );
	},
	false
);

document.addEventListener(
	'DOMContentLoaded',
	() => {
		new Spider( '.c-entries-carousel' );
	},
	false
);

document.addEventListener(
	'DOMContentLoaded',
	() => {
		const resizeObserver = new ResizeObserver( ( entries ) => {
			for ( const entry of entries ) {
				entry.target.style.setProperty( '--scrollbar-width', `${ window.innerWidth - entry.target.clientWidth }px` );
			}
		} );
		const target = getHtml();
		resizeObserver.observe( target );
	},
	false
);

document.addEventListener( 'DOMContentLoaded', () => {
	const header = getHeader();
	if ( header ) {
		if ( maybeLeftHeaderLayout( header ) ) {
			const setItemsVars = ( items ) => {
				forEachHtmlNodes( items, ( item ) => {
					const rect = item.getBoundingClientRect();
					const headerRect = header.getBoundingClientRect();
					item.style.setProperty( '--rect-top', `${ rect.top - headerRect.top }px` );
					item.style.setProperty( '--rect-right', `${ rect.right }px` );
					item.style.setProperty( '--rect-height', `${ rect.height }px` );
					item.style.setProperty( '--rect-width', `${ rect.width }px` );
				} );
			};

			const items = header.querySelectorAll( '.p-global-nav .c-navbar__item' );
			setItemsVars( items );

			window.addEventListener( 'resize', () => {
				setItemsVars( items );
			} );

			header.querySelector( '.l-header__content' ).addEventListener( 'wheel', () => {
				setItemsVars( items );
				forEachHtmlNodes( items.children, ( child ) => {
					if ( child.classList.contain( '.c-navbar__submenu' ) ) {
						submenu.setAttribute( 'aria-hidden', 'true' );
					}
				} );
			} );

			const resizeObserver = new ResizeObserver( () => {
				setTimeout( () => setItemsVars( items ), 100 );
			} );
			resizeObserver.observe( header );
		}
	}
} );

document.addEventListener( 'DOMContentLoaded', () => {
	const contents = document.querySelector( '.l-contents' );
	if ( ! contents ) {
		return;
	}

	const main = contents.querySelector( '.l-contents__main' );
	const sidebar = contents.querySelector( '.l-contents__sidebar' );
	if ( ! main || ! sidebar ) {
		contents.setAttribute( 'data-with-sidebar', false );
		return;
	}

	const resizeObserver = new ResizeObserver( () => {
		const maybeWithSidebar = main.offsetWidth !== sidebar.offsetWidth || main.getBoundingClientRect().top === sidebar.getBoundingClientRect().top;

		contents.setAttribute( 'data-with-sidebar', maybeWithSidebar );
	} );
	resizeObserver.observe( contents );
} );
