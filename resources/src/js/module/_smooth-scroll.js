'use strict';

import $ from 'jquery';
import '../../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';

import {
  getHeader,
  getAdminbar,
  getHtml,
  getDropNavWrapper,
  getStyle,
} from './_helper';

export default class SmoothScroll {
  constructor(link) {
    $(link).SmoothScroll({
      duration: 1000,
      easing  : 'easeOutQuint',
      offset  : () => this._getaAminbarHeight()
    });
  }

  _getaAminbarHeight() {
    const adminbarHeight = 'fixed' === getStyle(getAdminbar(), 'position') ? parseInt(getStyle(getHtml(), 'margin-top')) : 0;
    const dropNavWrapper = getDropNavWrapper();
    const header         = getHeader();
    const headerPosition = getStyle(header, 'position');

    if ('fixed' === headerPosition) {
      return header.offsetHeight + adminbarHeight;
    }

    if (!! dropNavWrapper && 'false' === dropNavWrapper.getAttribute('aria-hidden')) {
      return dropNavWrapper.offsetHeight + adminbarHeight;
    }

    return adminbarHeight;
  }
}
