'use strict';

import '@inc2734/dispatch-custom-resize-event';
import { sidebarStickyWidgetArea } from './module/_sidebar-sticky-widget-area';

import {
  getHeader,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header = getHeader();
    const target = document.querySelector('.l-sidebar-sticky-widget-area');

    if (! header || ! target) {
      return;
    }

    sidebarStickyWidgetArea(target, header);
    window.addEventListener('resize:width', () => sidebarStickyWidgetArea(target, header), false);
  },
  false
);
