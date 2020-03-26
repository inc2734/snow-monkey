'use strict';

import {
  getHeader,
  scrollTop,
  media,
  hasClass,
  getScrollOffset,
} from './_helper';

export function anchorPageScroll() {
  const hash = window.location.hash;
  if (! hash) {
    return;
  }

  const header = getHeader();
  if (! header) {
    return;
  }

  const scrollToTarget = (y) => {
    window.scrollTo(0, scrollTop() - y);
  }

  const defaultScrollTop = scrollTop();

  const init = () => {
    window.removeEventListener('scroll', init, false);

    if (0 < defaultScrollTop) {
      return;
    }

    const hasStickySm        = hasClass(header, 'l-header--sticky-sm');
    const hasStickyLg        = hasClass(header, 'l-header--sticky-lg');
    const hasStickyOverlaySm = hasClass(header, 'l-header--sticky-overlay-sm') || hasClass(header, 'l-header--sticky-overlay-colored-sm');
    const hasStickyOverlayLg = hasClass(header, 'l-header--sticky-overlay-lg') || hasClass(header, 'l-header--sticky-overlay-colored-lg');
    const activeHeaderSm     = media('max-width: 1023px') && (hasStickySm || hasStickyOverlaySm);
    const activeHeaderLg     = media('min-width: 1024px') && (hasStickyLg || hasStickyOverlayLg);

    scrollToTarget(getScrollOffset());
  };

  window.addEventListener('scroll', init, false);
}
