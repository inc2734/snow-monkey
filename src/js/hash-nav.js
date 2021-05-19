import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
//import { drawers } from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer';

import { getDrawerNav, getBody } from './module/_helper';

let openOverlayContainerLink;

/**
 * Set .u-noscroll to body.
 */
const setNoscroll = () => {
  const body = getBody();
  body.classList.add('u-noscroll');
};

/**
 * Drawer hash nav main proccess.
 */
const applyDrawerHashNav = (link) => {
  const drawer = getDrawerNav();
  if (! drawer) {
    return;
  }

  const id = drawer.getAttribute('id');
  if (! id) {
    return;
  }

  link.setAttribute('data-basis-drawer-toggle-btn', id);
}

/**
 * Overlay widget area hash nav main process.
 */
const applyOverlayWidgetAreaHashNav = (link) => link.addEventListener(
  'click',
  (event) => {
    const overlayWidgetArea = document.getElementById('sm-overlay-widget-area');
    if (!! overlayWidgetArea) {
      setNoscroll();
      openOverlayContainerLink = link;
    }
  },
  false
);

/**
 * Overlay search box hash nav main process.
 */
const applyOverlaySearchBoxHashNav = (link) => link.addEventListener(
  'click',
  (event) => {
    const overlaySearchBox = document.getElementById('sm-overlay-search-box');
    if (!! overlaySearchBox) {
      setNoscroll(overlaySearchBox);
      openOverlayContainerLink = link;
    }
  },
  false
);

/**
 * Overlay container closing proccess.
 */
const applyOverlayContainerClosers = (closer) => closer.addEventListener(
  'click',
  () => {
    const body = getBody();
    body.classList.remove('u-noscroll');
    if (!! openOverlayContainerLink) {
      openOverlayContainerLink.focus();
      openOverlayContainerLink = undefined;
    }
  },
  false
);

/**
 * Overlay container close with ESC key.
 */
const applyOverlayContainerEsc = (event) => {
  const target = document.querySelector('.c-overlay-container:target');
  if (!! target) {
    if (27 === event.keyCode) {
      const closeBtn = document.querySelector('.c-overlay-container__close-btn');
      if (!! closeBtn) {
        closeBtn.click();
      }
    }
  }
};

document.addEventListener(
  'DOMContentLoaded',
  () => {
    // #sm-drawer
    const drawerControlLinks = document.querySelectorAll('a[href="#sm-drawer"]');
    forEachHtmlNodes(drawerControlLinks, applyDrawerHashNav);

    // #sm-overlay-widget-area
    const overlayWidgetAreaLinks = document.querySelectorAll('a[href="#sm-overlay-widget-area"]');
    forEachHtmlNodes(overlayWidgetAreaLinks, applyOverlayWidgetAreaHashNav);

    // #sm-overlay-search-box
    const overlaySearchBoxLinks = document.querySelectorAll('a[href="#sm-overlay-search-box"]');
    forEachHtmlNodes(overlaySearchBoxLinks, applyOverlaySearchBoxHashNav);

    // .c-overlay-container
    const overlayContainerClosers = document.querySelectorAll('.c-overlay-container__bg, .c-overlay-container__close-btn');
    forEachHtmlNodes(overlayContainerClosers, applyOverlayContainerClosers);
    document.addEventListener('keydown', applyOverlayContainerEsc);
  },
  false
);
