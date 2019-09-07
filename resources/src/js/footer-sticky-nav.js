'use strict';

import { getFooterStickyNav, getBody, getStyle, setStyle } from './module/_helper.js';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { FooterStickyNav } from './module/_footer-sticky-nav.js';
import ActiveMenu from './module/_active-menu.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const nav = getFooterStickyNav();
    if (! nav) {
      return;
    }

    FooterStickyNav(nav);

    new ActiveMenu(
      nav,
      {
        home_url: snow_monkey.home_url,
      }
    );

    nav.addEventListener(
      'initFooterStickyNav',
      () => {
        const hidden = nav.getAttribute('aria-hidden');
        const body   = getBody();
        const marginBottom = 'true' === nav.getAttribute('aria-hidden') ? '' : `${nav.offsetHeight}px`;
        setStyle(body, 'marginBottom', marginBottom);
      },
      false
    );
  },
  false
);
