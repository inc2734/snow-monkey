'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

import {
  getHeader,
  getContents,
  media,
  hasClass,
} from './_helper';

export default class StickyHeader {
  constructor() {
    this.header   = getHeader();
    this.contents = getContents();

    if (! this.header || ! this.contents) {
      return;
    }

    this.hasStickySm = hasClass(this.header, 'l-header--sticky-sm');
    this.hasStickyLg = hasClass(this.header, 'l-header--sticky-lg');

    if ( ! this.hasStickySm && ! this.hasStickyLg) {
      return;
    }

    this._init();
    window.addEventListener('resize:width', () => this._init(), false);
  }

  _init() {
    const isStickySm = media('max-width: 1023px') && this.hasStickySm;
    const isStickyLg = media('min-width: 1024px') && this.hasStickyLg;
    const marginTop = isStickySm || isStickyLg ? `${ this.header.offsetHeight }px` : '';
    this.contents.style.marginTop = marginTop;
    addCustomEvent(window, 'afterStickyHeaderSetting');
  }
}
