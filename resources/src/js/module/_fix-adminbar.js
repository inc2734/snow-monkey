'use strict';

import '@inc2734/dispatch-custom-resize-event';

import {
  scrollTop,
  setStyle,
  getStyle,
  hasClass,
} from './_helper';

let hasStickySm;
let hasStickyOverlaySm;

export function fixAdminbar(header, adminbar) {
  const setHeaderPosition = (position) => {
    setStyle(header, 'position', position);
  };

  const setHeaderTop = (top) => {
    top = null !== top ? `${ parseInt(top) }px` : top;
    setStyle(header, 'top', top);
  };

  const fixHeaderPosition = () => {
    if (scrollTop() > adminbar.offsetHeight) {
      setHeaderPosition(null);
      setHeaderTop(0);
    } else {
      setHeaderPosition('absolute');
      setHeaderTop(null);
    }
  };

  const init = () => {
    if ('fixed' !== getStyle(adminbar, 'position') && (hasStickySm || hasStickyOverlaySm)) {
      window.addEventListener('scroll', fixHeaderPosition, false);
    } else {
      window.removeEventListener('scroll', fixHeaderPosition, false);
      setHeaderTop(null);
      setHeaderPosition(null);
    }
  };

  if ('undefined' === typeof hasStickySm) {
    hasStickySm = hasClass(header, 'l-header--sticky-sm');
  }

  if ('undefined' === typeof hasStickySm) {
    hasStickyOverlaySm = hasClass(header, 'l-header--sticky-overlay-sm') || hasClass(header, 'l-header--sticky-overlay-colored-sm');
  }

  init();

  window.addEventListener('resize:width', init, false);
}
