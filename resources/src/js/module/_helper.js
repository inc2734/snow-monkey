'use strict';

import addCustomEvent from '@inc2734/add-custom-event';

/**
 * Return html
 *
 * @return object|null
 */
export function getHtml() {
  const html = document.getElementsByTagName('html');
  if (1 > html.length) {
    return;
  }

  return html[0];
}

/**
 * Return #body
 *
 * @return object|null
 */
export function getBody() {
  return document.getElementById('body');
}

/**
 * Return #footer-sticky-nav
 *
 * @return object|null
 */
export function getFooterStickyNav() {
  return document.getElementById('footer-sticky-nav');
}

/**
 * Return .l-header
 *
 * @return object|null
 */
export function getHeader() {
  const header = document.getElementsByClassName('l-header');
  if (1 > header.length) {
    return;
  }

  return header[0];
}

/**
 * Return .l-header__drop-nav
 *
 * @return object|null
 */
export function getDropNavWrapper() {
  const dropNavWrapper = document.getElementsByClassName('l-header__drop-nav');
  if (1 > dropNavWrapper.length) {
    return;
  }

  return dropNavWrapper[0];
}

/**
 * Return .l-contents
 *
 * @return object|null
 */
export function getContents() {
  const contents = document.getElementsByClassName('l-contents');
  if (1 > contents.length) {
    return;
  }

  return contents[0];
}

/**
 * Return .l-container
 *
 * @return object|null
 */
export function getContainer() {
  const container = document.getElementsByClassName('l-container');
  if (1 > container.length) {
    return;
  }

  return container[0];
}

/**
 * Return #wpadminbar
 *
 * @return object|null
 */
export function getAdminbar() {
  return document.getElementById('wpadminbar');
}

/**
 * Return #drawer-nav
 *
 * @return object|null
 */
export function getDrawerNav() {
  return document.getElementById('drawer-nav');
}

/**
 * Return scroll position
 *
 * @return int
 */
export function scrollTop() {
  return document.documentElement.scrollTop || document.body.scrollTop;
}

/**
 * Return specific css property
 *
 * @param object element
 * @param string CSS property
 * @return string
 */
export function getStyle(element, property) {
  if (! element) {
    return undefined;
  }

  return window.getComputedStyle(element).getPropertyValue(property);
}

/**
 * Set specific css property
 *
 * @param object element
 * @param string CSS property
 */
export function setStyle(element, property, value) {
  element.style[property] = value;
}

/**
 * Return true when match the media query
 *
 * @return boolean
 */
export function media(query) {
  return window.matchMedia(`(${query})`).matches;
}

/**
 * Return true when the target has the class
 *
 * @return boolean
 */
export function hasClass(target, className) {
  return target.classList.contains(className);
}

/**
 * [getScrollOffset description]
 *
 * @param Object
 *    @var boolean forceDropNav Default false.
 */
export function getScrollOffset(option = {}) {
	const header = getHeader();
	const adminbar = getAdminbar();

	const headerPosition = getStyle(header, 'position');
	const headerHeight = header ? header.offsetHeight : 0;
  const adminbarPosition = getStyle(adminbar, 'position');
  const adminbarHeight = 'fixed' === adminbarPosition ? parseInt(getStyle(getHtml(), 'margin-top')) : 0;

	if ('fixed' === headerPosition) {
		return headerHeight + adminbarHeight;
	}

  return adminbarHeight;
}
