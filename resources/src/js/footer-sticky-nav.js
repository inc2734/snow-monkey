'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import SnowMonkeyFooterStickyNav from './module/_footer-sticky-nav.js';
import SnowMonkeyActiveMenu from './module/_active-menu.js';

new SnowMonkeyFooterStickyNav();

document.addEventListener(
  'DOMContentLoaded',
  () => {
    forEachHtmlNodes(
      document.querySelectorAll('.p-footer-sticky-nav'),
      (nav) => {
        new SnowMonkeyActiveMenu(
          nav,
          {
            home_url: snow_monkey.home_url,
          }
        );
      }
    );
  },
  false
);
