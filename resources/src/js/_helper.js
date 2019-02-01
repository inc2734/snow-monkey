'use strict';

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
 * Return data-l-header-type of header
 *
 * @return string
 */
export function getHeaderType() {
  const header = getHeader();
  return header.getAttribute('data-l-header-type');
}

/**
 * Return data-l-header-type of header
 *
 * @return string
 */
export function setHeaderType(value) {
  const header = getHeader();
  return header.setAttribute('data-l-header-type', value);
}

/**
 * Return data-snow-monkey-default-header-position
 *
 * @return string
 */
export function getDefaultHeaderPosition() {
  const header = getHeader();
  return header.getAttribute('data-snow-monkey-default-header-position');
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
export function getAdminBar() {
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
 * Return snow_monkey.header_position_only_mobile
 *
 * @return boolean
 */
export function isHeaderPositionOnlyMobile() {
  return false === snow_monkey.header_position_only_mobile ? false : true;
}

/**
 * Return true when dropnav will show
 *
 * @return boolean
 */
export function maybeShowDropNav() {
  const header = getHeader();
  const dropNavWrapper = getDropNavWrapper();

  if (! header || ! dropNavWrapper) {
    return false;
  }

  if (! window.matchMedia('(min-width: 1024px)').matches) {
    return false;
  }

  const headerOffsetTop = header.offsetHeight + header.getBoundingClientRect().top + scrollTop();
  if (headerOffsetTop > scrollTop()) {
    return false;
  }

  if (! isHeaderPositionOnlyMobile()) {
    return false;
  }

  return true;
}
