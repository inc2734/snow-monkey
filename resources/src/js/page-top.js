'use strict';

import {PageTopBtn} from './module/_pagetop-btn.js';
import {getFooterStickyNav, setStyle, getStyle} from './module/_helper.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const pageTop = document.querySelector('.c-page-top');
    if (! pageTop) {
      return;
    }

    PageTopBtn(pageTop);

    const footerStickyNav = getFooterStickyNav();
    if (! footerStickyNav) {
      return;
    }

    const defaultPosition = getStyle(pageTop, 'bottom');

    footerStickyNav.addEventListener(
      'initFooterStickyNav',
      () => {
        setTimeout(
          () => {
            const isOverlapping = parseInt(defaultPosition) < parseInt(footerStickyNav.offsetHeight);
            const bottom = isOverlapping ? `${footerStickyNav.offsetHeight}px` : '';
            setStyle(pageTop, 'bottom', bottom);
          },
          100
        );
      }
    );
  },
  false
);
