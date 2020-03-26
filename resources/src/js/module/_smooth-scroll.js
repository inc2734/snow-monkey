'use strict';

import $ from 'jquery';
import '../../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';

import {
  getScrollOffset,
} from './_helper';

export function smoothScroll(selector) {
  $(document).SmoothScroll({
    target  : selector,
    duration: 1000,
    easing  : 'easeOutQuint',
    offset  : () => getScrollOffset(),
  });
}
