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

    footerStickyNav.addEventListener(
      'initFooterStickyNav',
      () => {
        setStyle(pageTop, 'bottom', '');

        setTimeout(
          () => {
            const isOverlapping = parseInt(getStyle(pageTop, 'bottom')) < parseInt(footerStickyNav.offsetHeight);
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
