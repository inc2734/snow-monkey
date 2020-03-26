'use strict';

import { getFooterStickyNav } from './module/_helper';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { applyFooterStickyNav } from './module/_footer-sticky-nav';
import { activeMenu } from './module/_active-menu';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const nav = getFooterStickyNav();
    if (! nav) {
      return;
    }

    applyFooterStickyNav(nav);

    const links = nav.getElementsByTagName('a');

    const applyActiveMenu = (atag) => {
      const params = {
        home_url: snow_monkey.home_url,
      };
      activeMenu(atag, params);
    };

    forEachHtmlNodes(links, applyActiveMenu);
  },
  false
);
