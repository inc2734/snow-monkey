'use strict';

import HashNav from './module/_hash-nav.js';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const drawerControlLinks = document.querySelectorAll('a[href="#sm-drawer"]');
    forEachHtmlNodes(drawerControlLinks, (link) => new HashNav(link));
  },
  false
);
