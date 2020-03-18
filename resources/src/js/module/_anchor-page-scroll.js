'use strict';

import {
  getHeader,
  scrollTop,
  media,
  hasClass,
  getScrollOffset,
} from './_helper';

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

    this.defaultScrollTop = scrollTop();

    this._init = this._init.bind(this);
    window.addEventListener('scroll', this._init, false);
  }

  _init() {
    window.removeEventListener('scroll', this._init, false);

    if (0 < this.defaultScrollTop) {
      return;
    }

    const hasStickySm        = hasClass(this.header, 'l-header--sticky-sm');
    const hasStickyLg        = hasClass(this.header, 'l-header--sticky-lg');
    const hasStickyOverlaySm = hasClass(this.header, 'l-header--sticky-overlay-sm') || hasClass(this.header, 'l-header--sticky-overlay-colored-sm');
    const hasStickyOverlayLg = hasClass(this.header, 'l-header--sticky-overlay-lg') || hasClass(this.header, 'l-header--sticky-overlay-colored-lg');
    const activeHeaderSm     = media('max-width: 1023px') && (hasStickySm || hasStickyOverlaySm);
    const activeHeaderLg     = media('min-width: 1024px') && (hasStickyLg || hasStickyOverlayLg);

    this._scrollToTarget(getScrollOffset());
  }

  _scrollToTarget(y) {
    window.scrollTo(0, scrollTop() - y);
  }
}
