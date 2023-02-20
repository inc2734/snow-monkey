import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { widgetItemExpander } from './module/_widget-item-expander';
import { activeMenu } from './module/_active-menu';

document.addEventListener(
	'DOMContentLoaded',
	() => {
		const targets = [ '.cat-item .children', '.menu-item .sub-menu' ];
		const submenus = document.querySelectorAll( targets.join( ',' ) );

		forEachHtmlNodes( submenus, widgetItemExpander );
	},
	false
);

document.addEventListener( 'DOMContentLoaded', () => {
	const navs = document.querySelectorAll( '.wpaw-local-nav__sublist' );
	if ( 1 > navs.length ) {
		return;
	}

	forEachHtmlNodes( navs, ( nav ) => {
		const links = nav.getElementsByTagName( 'a' );

		const applyActiveMenu = ( atag ) => {
			const params = {
				home_url: snow_monkey.home_url,
			};
			activeMenu( atag, params );
		};

		forEachHtmlNodes( links, applyActiveMenu );
	} );
} );
