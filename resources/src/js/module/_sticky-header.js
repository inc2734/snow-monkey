'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

import {
  getHeader,
  getContents,
  media,
  hasClass,
  setStyle,
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

    this.hasSOverlaySm             = hasClass(this.header, 'l-header--overlay-sm');
    this.hasSOverlayLg             = hasClass(this.header, 'l-header--overlay-lg');
    this.hasStickyOverlaySm        = hasClass(this.header, 'l-header--sticky-overlay-sm');
    this.hasStickyOverlayLg        = hasClass(this.header, 'l-header--sticky-overlay-lg');
    this.hasStickyOverlayColoredSm = hasClass(this.header, 'l-header--sticky-overlay-colored-sm');
    this.hasStickyOverlayColoredLg = hasClass(this.header, 'l-header--sticky-overlay-colored-lg');
    this.hasSOverlaySm             = this.hasSOverlaySm || this.hasStickyOverlaySm || this.hasStickyOverlayColoredSm;
    this.hasSOverlayLg             = this.hasSOverlayLg || this.hasStickyOverlayLg || this.hasStickyOverlayColoredLg;

    if (! this.hasStickySm && ! this.hasStickyLg && ! this.hasSOverlaySm && ! this.hasSOverlayLg) {
      return;
    }

    this._init();
    window.addEventListener('resize:width', () => this._init(), false);
  }

  _init() {
    const marginTop = () => {
      const isSticky   = this.hasStickySm || this.hasStickyLg;
      const isStickySm = media('max-width: 1023px') && this.hasStickySm;
      const isStickyLg = media('min-width: 1024px') && this.hasStickyLg;

      const isOverlay   = this.hasSOverlaySm || this.hasSOverlayLg;
      const isOverlaySm = media('max-width: 1023px') && this.hasSOverlaySm;
      const isOverlayLg = media('min-width: 1024px') && this.hasSOverlayLg;
      const infobar     = this.header.querySelector('.p-infobar');

      if (isSticky && (isStickySm || isStickyLg)) {
        return `${ this.header.offsetHeight }px`;
      }

      if (isOverlay && infobar && (isOverlaySm || isOverlayLg)) {
        return `${ infobar.offsetHeight }px`;
      }

      return '';
    };

    setStyle(this.contents, 'marginTop', marginTop());
    addCustomEvent(window, 'afterStickyHeaderSetting');
  }
}
