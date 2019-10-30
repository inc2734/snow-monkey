'use strict';

import $ from 'jquery';
import '../../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';
import { getHeaderType, getHeader, getAdminBar, getHtml, getDropNavWrapper, getStyle } from './_helper';

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
    const dropNavWrapper = getDropNavWrapper();

    if ('sticky' === headerType || 'overlay' === headerType) {
      return getHeader().offsetHeight + adminBarHeight;
    }

    if (!! dropNavWrapper && 'false' === dropNavWrapper.getAttribute('aria-hidden')) {
      return dropNavWrapper.offsetHeight + adminBarHeight;
    }

    return adminBarHeight;
  }
}
