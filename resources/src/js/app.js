'use strict';

import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header';
import AnchorPageScroll from './module/_anchor-page-scroll';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    new BasisStickyHeader();
    new AnchorPageScroll();
  },
  false
);
