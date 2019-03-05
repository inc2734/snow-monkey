'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import SnowMonkeyActiveMenu from './module/_active-menu.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    forEachHtmlNodes(
      document.querySelectorAll('.p-global-nav'),
      (nav) => {
        new SnowMonkeyActiveMenu(
          nav,
          {
            home_url: snow_monkey.home_url,
          }
        );
      }
    );
  }
);
