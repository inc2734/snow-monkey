'use strict';

import { stickyHeader } from './module/_sticky-header';

import {
  getHeader,
  getContents,
  media,
  hasClass,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header   = getHeader();
    const contents = getContents();

    if (! header || ! contents) {
      return;
    }

    const _hasOverlaySm              = hasClass(header, 'l-header--overlay-sm');
    const _hasOverlayLg              = hasClass(header, 'l-header--overlay-lg');
    const _hasStickyOverlaySm        = hasClass(header, 'l-header--sticky-overlay-sm');
    const _hasStickyOverlayLg        = hasClass(header, 'l-header--sticky-overlay-lg');
    const _hasStickyOverlayColoredSm = hasClass(header, 'l-header--sticky-overlay-colored-sm');
    const _hasStickyOverlayColoredLg = hasClass(header, 'l-header--sticky-overlay-colored-lg');

    const hasOverlaySm = _hasOverlaySm || _hasStickyOverlaySm || _hasStickyOverlayColoredSm;
    const hasOverlayLg = _hasOverlayLg || _hasStickyOverlayLg || _hasStickyOverlayColoredLg;

    const hasStickySm = hasClass(header, 'l-header--sticky-sm');
    const hasStickyLg = hasClass(header, 'l-header--sticky-lg');

    if (! hasStickySm && ! hasStickyLg && ! hasOverlaySm && ! hasOverlayLg) {
      return;
    }

    const marginTop = () => {
      const isSticky   = hasStickySm || hasStickyLg;
      const isStickySm = media('max-width: 1023px') && hasStickySm;
      const isStickyLg = media('min-width: 1024px') && hasStickyLg;

      const isOverlay   = hasOverlaySm || hasOverlayLg;
      const isOverlaySm = media('max-width: 1023px') && hasOverlaySm;
      const isOverlayLg = media('min-width: 1024px') && hasOverlayLg;
      const infobar     = header.querySelector('.p-infobar');

      if (isSticky && (isStickySm || isStickyLg)) {
        return `${ header.offsetHeight }px`;
      }

      if (isOverlay && infobar && (isOverlaySm || isOverlayLg)) {
        return `${ infobar.offsetHeight }px`;
      }

      return '';
    };

    stickyHeader(contents, marginTop);
    window.addEventListener('resize:width', () => stickyHeader(contents, marginTop), false);
  },
  false
);
