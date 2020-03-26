'use strict';

import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import { anchorPageScroll } from './module/_anchor-page-scroll';
import { scrollChecker } from './module/_scroll-checker';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    anchorPageScroll();
    scrollChecker();
  },
  false
);
