'use strict';

import { getHeader, getHeaderType, getAdminBar, getDropNavWrapper, getStyle, setStyle } from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header = getHeader();

    const init = () => {
      const target   = document.querySelector('.l-sidebar-sticky-widget-area');
      const isSticky = 'sticky' === getStyle(target, 'position');

      if (! target) {
        return;
      }

      if (! isSticky) {
        setStyle(target, 'top', '');
        return;
      }

      const targetMargin   = parseInt(getStyle(target, 'margin-top'));
      const adminBar       = getAdminBar();
      const adminBarHeight = adminBar ? adminBar.offsetHeight : 0;
      const headerType     = getHeaderType();

      if ('sticky' === headerType || 'overlay' === headerType) {
        const headerHeight = header ? header.offsetHeight : 0;
        const offset = headerHeight + adminBarHeight + targetMargin;
        offset && setStyle(target, 'top', `${offset}px`);
      } else {
        const dropNav = getDropNavWrapper();
        const dropNavHeight = dropNav ? dropNav.offsetHeight : 0;
        const offset = dropNavHeight + adminBarHeight + targetMargin;
        offset && setStyle(target, 'top', `${offset}px`);
      }
    };

    init();
    window.addEventListener('resize', () => init(), false);
    header && header.addEventListener('setHeaderType', () => init(), false)
  }
);
