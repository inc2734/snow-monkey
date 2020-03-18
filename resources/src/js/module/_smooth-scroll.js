'use strict';

import $ from 'jquery';
import '../../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';

import {
  getScrollOffset,
} from './_helper';

export default class SmoothScroll {
  constructor(link) {
    $(link).SmoothScroll({
      duration: 1000,
      easing  : 'easeOutQuint',
      offset  : () => getScrollOffset()
    });
  }
}
