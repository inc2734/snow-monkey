'use strict';

import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import { scrollChecker } from './module/_scroll-checker';

import {
  getHeader,
  getHtml,
  scrollTop,
  getScrollOffset,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const hash = window.location.hash;
    if (! hash) {
      return;
    }

    const header = getHeader();
    if (! header) {
      return;
    }

    const apply = () => {
      window.removeEventListener('scroll', apply, false);
      window.scrollTo(0, scrollTop() - getScrollOffset());
    };

    window.addEventListener('scroll', apply, false);
  },
  false
);

scrollChecker(getHtml());
