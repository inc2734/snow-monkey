'use strict';

import $ from 'jquery';
import '../../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';
import {getHeaderType, getHeader, getAdminBar, getHtml, getDropNavWrapper, getStyle} from './_helper.js';

export default class SmoothScroll {
  constructor(link) {
    $(link).SmoothScroll({
      duration: 1000,
      easing  : 'easeOutQuint',
      offset  : () => this._getAdminBarHeight()
    });
  }

  _getAdminBarHeight() {
    const headerType     = getHeaderType();
    const adminBarHeight = 'fixed' === getStyle(getAdminBar(), 'position') ? parseInt(getStyle(getHtml(), 'margin-top')) : 0;

    if ('sticky' === headerType || 'overlay' === headerType) {
      return getHeader().offsetHeight + adminBarHeight;
    }

    if ('false' === getDropNavWrapper().getAttribute('aria-hidden')) {
      return getDropNavWrapper().offsetHeight + adminBarHeight;
    }

    return adminBarHeight;
  }
}
