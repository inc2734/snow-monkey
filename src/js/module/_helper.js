/**
 * Return html
 *
 * @return object|null
 */
export function getHtml() {
	const html = document.getElementsByTagName( 'html' );
	if ( 1 > html.length ) {
		return;
	}

	return html[ 0 ];
}

/**
 * Return #body
 *
 * @return object|null
 */
export function getBody() {
	return document.getElementById( 'body' );
}

/**
 * Return #footer-sticky-nav
 *
 * @return object|null
 */
export function getFooterStickyNav() {
	return document.getElementById( 'footer-sticky-nav' );
}

/**
 * Return .l-header
 *
 * @return object|null
 */
export function getHeader() {
	const header = document.getElementsByClassName( 'l-header' );
	if ( 1 > header.length ) {
		return;
	}

	return header[ 0 ];
}

/**
 * Return .l-header__drop-nav
 *
 * @return object|null
 */
export function getDropNavWrapper() {
	const dropNavWrapper = document.getElementsByClassName( 'l-header__drop-nav' );
	if ( 1 > dropNavWrapper.length ) {
		return;
	}

	return dropNavWrapper[ 0 ];
}

/**
 * Return .l-contents
 *
 * @return object|null
 */
export function getContents() {
	const contents = document.getElementsByClassName( 'l-contents' );
	if ( 1 > contents.length ) {
		return;
	}

	return contents[ 0 ];
}

/**
 * Return .l-container
 *
 * @return object|null
 */
export function getContainer() {
	const container = document.getElementsByClassName( 'l-container' );
	if ( 1 > container.length ) {
		return;
	}

	return container[ 0 ];
}

/**
 * Return #wpadminbar
 *
 * @return object|null
 */
export function getAdminbar() {
	return document.getElementById( 'wpadminbar' );
}

/**
 * Return #drawer-nav
 *
 * @return object|null
 */
export function getDrawerNav() {
	return document.getElementById( 'drawer-nav' );
}

/**
 * Return specific css property
 *
 * @param object element
 * @param string CSS property
 * @return string
 */
export function getStyle( element, property ) {
	if ( ! element ) {
		return undefined;
	}

	return window.getComputedStyle( element ).getPropertyValue( property );
}

/**
 * Set specific css property
 *
 * @param object element
 * @param string CSS property
 */
export function setStyle( element, property, value ) {
	element.style[ property ] = value;
}

/**
 * Return true when dropnav will show
 *
 * @return boolean
 */
export function shouldShowDropNav() {
	const header = getHeader();
	const dropNavWrapper = getDropNavWrapper();

	if ( ! header || ! dropNavWrapper ) {
		return false;
	}

	return true;
}

/**
 * Return true when match the media query
 *
 * @return boolean
 */
export function media( query ) {
	return window.matchMedia( `(${ query })` ).matches;
}

/**
 * Return true when the target has the class
 *
 * @return boolean
 */
export function hasClass( target, className ) {
	return target.classList.contains( className );
}

export function maybeLeftHeaderLayout( header ) {
	return header.offsetWidth < document.documentElement.clientWidth;
}

/**
 * [getScrollOffset description]
 *
 * @param Object
 *    @var boolean forceDropNav Default false.
 */
export function getScrollOffset( option = {} ) {
	const adminbar = getAdminbar();
	let adminbarHeight = 0;
	if ( adminbar ) {
		adminbarHeight = 'fixed' === getStyle( adminbar, 'position' ) ? parseInt( getStyle( getHtml(), 'margin-top' ) ) : adminbarHeight;
	}

	const header = getHeader();
	if ( header ) {
		const position = getStyle( header, 'position' );
		if ( 'absolute' === position || 'fixed' === position || 'sticky' === position ) {
			const headerHeight = maybeLeftHeaderLayout( header ) ? 0 : header.offsetHeight;
			return headerHeight + adminbarHeight;
		}

		const dropNav = getDropNavWrapper();
		if ( dropNav ) {
			const dropNavHeight = true === option.forceDropNav || shouldShowDropNav() ? dropNav.offsetHeight : 0;

			return dropNavHeight + adminbarHeight;
		}
	}

	return adminbarHeight;
}

/**
 * Add [aria-hidden="true"] to element
 *
 * @param Object element
 */
export function hide( element ) {
	element.setAttribute( 'aria-hidden', 'true' );
}

/**
 * Add [aria-hidden="false"] to element
 *
 * @param Object element
 */
export function show( element ) {
	element.setAttribute( 'aria-hidden', 'false' );
}

/**
 * Creates a throttled function that only invokes 'callback' at most once per every 'delay' milliseconds.
 *
 * @param function callback
 * @param int delay
 */
export function throttle( callback, delay ) {
	let time = Date.now();
	return () => {
		if ( time + delay - Date.now() < 0 ) {
			callback.apply( this, arguments );
			time = Date.now();
		}
	};
}

/**
 * check for the passive option
 *
 * @return boolean
 */
export function isPassiveSupported() {
	let passiveSupported = false;

	try {
		const options = Object.defineProperty( {}, 'passive', {
			get: () => {
				passiveSupported = true;
			},
		} );

		window.addEventListener( 'test', options, options );
		window.removeEventListener( 'test', options, options );
	} catch ( err ) {
		passiveSupported = false;
	}

	return passiveSupported;
}

/**
 * Return hash target offsetTop.
 *
 * @return int|false
 */
export function getTargetOffsetTop() {
	const hash = window.location.hash;
	if ( ! hash ) {
		return false;
	}

	const target = document.getElementById( decodeURI( hash ).replace( /^#/, '' ) );
	if ( ! target ) {
		return false;
	}

	return window.pageYOffset + target.getBoundingClientRect().top;
}
