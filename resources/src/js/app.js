'use strict';

import '../../assets/packages/slick-carousel';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header.js';
import AnchorPageScroll from './module/_anchor-page-scroll.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    new BasisStickyHeader();
    new AnchorPageScroll();
  },
  false
);
