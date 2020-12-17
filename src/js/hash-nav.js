import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import BasisDrawer from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer';

import { getDrawerNav, getBody } from './module/_helper';

const setNoscroll = (target) => {
  if ( ! target ) {
    return;
  }

  const body = getBody();
  body.classList.add('u-noscroll');
};

const applyDrawerHashNav = (link) => link.addEventListener(
  'click',
  (event) => {
    const drawer = getDrawerNav();
    if (! drawer) {
      return;
    }

    event.stopPropagation();

    'false' === drawer.getAttribute('aria-hidden')
      ? BasisDrawer.close(drawer)
      : BasisDrawer.open(drawer);

    return false;
  },
  false
);

const applyOverlayWidgetAreaHashNav = (link) => link.addEventListener(
  'click',
  (event) => setNoscroll(document.getElementById('sm-overlay-widget-area')),
  false
);

const applyOverlaySearchBoxHashNav = (link) => link.addEventListener(
  'click',
  (event) => setNoscroll(document.getElementById('sm-overlay-search-box')),
  false
);

const applyOverlayContainerClosers = (closer) => closer.addEventListener(
  'click',
  () => {
    const body = getBody();
    body.classList.remove('u-noscroll');
  },
  false
);

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
