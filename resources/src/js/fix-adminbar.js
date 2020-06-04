'use strict';

import '@inc2734/dispatch-custom-resize-event';

import { fixAdminbar } from './module/_fix-adminbar';

import {
  getHeader,
  getAdminbar,
  scrollTop,
  setStyle,
  getStyle,
  hasClass,
} from './module/_helper';

const apply = (header, adminbar) => {

  const hasStickySm = hasClass(header, 'l-header--sticky-sm');
  const hasStickyOverlaySm = hasClass(header, 'l-header--sticky-overlay-sm')
                          || hasClass(header, 'l-header--sticky-overlay-colored-sm');

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

  init();

  window.addEventListener('resize:width', init, false);
};

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header   = getHeader();
    const adminbar = getAdminbar();

    if ( ! header || ! adminbar) {
      return;
    }

    apply(header, adminbar);
  },
  false
);
