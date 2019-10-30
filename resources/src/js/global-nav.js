'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import ActiveMenu from './module/_active-menu';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    forEachHtmlNodes(
      document.querySelectorAll('.p-global-nav'),
      (nav) => {
        new ActiveMenu(
          nav,
          {
            home_url: snow_monkey.home_url,
          }
        );
      }
    );
  }
);
