'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

import {
  getHeader,
  getContents,
  media,
  hasClass,
  setStyle,
} from './module/_helper';

const hasStickySm = (header) => hasClass(header, 'l-header--sticky-sm');
const hasStickyLg = (header) => hasClass(header, 'l-header--sticky-lg');

const hasOverlaySm = (header) => {
  return hasClass(header, 'l-header--overlay-sm')
      || hasClass(header, 'l-header--sticky-overlay-sm')
      || hasClass(header, 'l-header--sticky-overlay-colored-sm');
};

const hasOverlayLg = (header) => {
  return hasClass(header, 'l-header--overlay-lg')
      || hasClass(header, 'l-header--sticky-overlay-lg')
      || hasClass(header, 'l-header--sticky-overlay-colored-lg');
};

const applyStickyHeader = (contents, marginTop) => {
  setStyle(contents, 'marginTop', marginTop());
  addCustomEvent(window, 'afterStickyHeaderSetting');
};

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header   = getHeader();
    const contents = getContents();

    if (! header || ! contents) {
      return;
    }

    const _hasStickySm  = hasStickySm(header);
    const _hasStickyLg  = hasStickyLg(header);
    const _hasOverlaySm = hasOverlaySm(header);
    const _hasOverlayLg = hasOverlayLg(header);

    if (! _hasStickySm && ! _hasStickyLg && ! _hasOverlaySm && ! _hasOverlayLg) {
      return;
    }

    const marginTop = () => {
      const isStickySm = media('max-width: 1023px') && _hasStickySm;
      const isStickyLg = media('min-width: 1024px') && _hasStickyLg;
      if (isStickySm || isStickyLg) {
        return `${ header.offsetHeight }px`;
      }

      const isOverlaySm = media('max-width: 1023px') && _hasOverlaySm;
      const isOverlayLg = media('min-width: 1024px') && _hasOverlayLg;
      const infobar     = header.querySelector('.p-infobar');
      if (!! infobar && (isOverlaySm || isOverlayLg)) {
        return `${ infobar.offsetHeight }px`;
      }

      return '';
    };

    applyStickyHeader(contents, marginTop);
    window.addEventListener('resize:width', () => applyStickyHeader(contents, marginTop), false);
  },
  false
);
