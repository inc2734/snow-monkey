'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { activeMenu } from './module/_active-menu';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const navs = document.querySelectorAll('.p-global-nav');
    if ( 1 > navs.length) {
      return;
    }

    const apply = (nav) => {
      const links = nav.getElementsByTagName('a');

      const applyActiveMenu = (atag) => {
        const params = {
          home_url: snow_monkey.home_url,
        };
        activeMenu(atag, params);
      };

      forEachHtmlNodes(links, applyActiveMenu);
    };

    forEachHtmlNodes(navs, apply);
  }
);
