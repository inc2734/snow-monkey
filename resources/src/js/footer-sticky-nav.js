'use strict';

import {getFooterStickyNav} from './module/_helper.js';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import {FooterStickyNav} from './module/_footer-sticky-nav.js';
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
  },
  false
);
