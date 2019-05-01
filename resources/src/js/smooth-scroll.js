'use strict';

import SmoothScroll from './module/_smooth-scroll.js';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

window.addEventListener(
  'load',
  () => {
    const smoothScrollLinks = document.querySelectorAll(
      [
        '.c-page-top a[href^="#"]',
        '.wpco a[href^="#"]',
        '.u-smooth-scroll[href*="#"]',
        '.u-smooth-scroll a[href*="#"]',
      ].join(',')
    );
    forEachHtmlNodes(smoothScrollLinks, (link) => new SmoothScroll(link));
  },
  false
);
