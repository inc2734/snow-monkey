'use strict';

import { hashNav } from './module/_hash-nav';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const drawerControlLinks = document.querySelectorAll('a[href="#sm-drawer"]');
    forEachHtmlNodes(drawerControlLinks, hashNav);
  },
  false
);
