'use strict';

import { getHeader, getDropNavWrapper, scrollTop, getHeaderType, shouldShowDropNav, getStyle, getAdminBar, getHtml } from './_helper';

export default class AnchorPageScroll {
  constructor() {
    this.hash = window.location.hash;
    if (! this.hash) {
      return;
    }

    this.header = getHeader();
    if (! this.header) {
      return;
    }

    this.dropNavWrapper   = getDropNavWrapper();
    this.defaultScrollTop = scrollTop();

    this._scrollEvent = this._scrollEvent.bind(this);
    window.addEventListener('scroll', this._scrollEvent, false);
  }

  _scrollEvent() {
    window.removeEventListener('scroll', this._scrollEvent, false);

    if (0 < this.defaultScrollTop) {
      return;
    }

    const adminBarHeight = 'fixed' === getStyle(getAdminBar(), 'position') ? parseInt(getStyle(getHtml(), 'margin-top')) : 0;

    if (shouldShowDropNav() && !! this.dropNavWrapper) {
      this._scrollToTarget(this.dropNavWrapper.offsetHeight + adminBarHeight);
    } else if ('sticky' === getHeaderType() || 'overlay' === getHeaderType()) {
      this._scrollToTarget(this.header.offsetHeight + adminBarHeight);
    } else if (0 < adminBarHeight) {
      this._scrollToTarget(adminBarHeight);
    }
  }

  _scrollToTarget(y) {
    window.scrollTo(0, scrollTop() - y);
  }
}
