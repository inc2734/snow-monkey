'use strict';

import '@inc2734/dispatch-custom-resize-event';

import {
  getHeader,
  getHtml,
  getAdminbar,
  scrollTop,
  setStyle,
  getStyle,
  hasClass,
} from './_helper';

export default class Fixadminbar {
  constructor() {
    this.header   = getHeader();
    this.html     = getHtml();
    this.adminbar = getAdminbar();

    if ( ! this.header || ! this.adminbar) {
      return;
    }

    this._fixHeaderPosition = this._fixHeaderPosition.bind(this);

    this._init()
    window.addEventListener('resize:width', () => this._init(), false);
  }

  _init() {
    const hasStickySm        = hasClass(this.header, 'l-header--sticky-sm');
    const hasStickyOverlaySm = hasClass(this.header, 'l-header--sticky-overlay-sm') || hasClass(this.header, 'l-header--sticky-overlay-colored-sm');

    if ('fixed' !== getStyle(this.adminbar, 'position') && (hasStickySm || hasStickyOverlaySm)) {
      window.addEventListener('scroll', this._fixHeaderPosition, false);
      this._fixHeaderPosition()
    } else {
      window.removeEventListener('scroll', this._fixHeaderPosition, false);
      this._setHeaderTop(null);
      this._setHeaderPosition(null);
    }
  }

  _fixHeaderPosition() {
    if (scrollTop() > this.adminbar.offsetHeight) {
      this._setHeaderPosition(null);
      this._setHeaderTop(0);
    } else {
      this._setHeaderPosition('absolute');
      this._setHeaderTop(null);
    }
  }

  _setHeaderPosition(position) {
    setStyle(this.header, 'position', position);
  }

  _setHeaderTop(top) {
    top = null !== top ? `${parseInt(top)}px` : top;
    setStyle(this.header, 'top', top);
  }
}
