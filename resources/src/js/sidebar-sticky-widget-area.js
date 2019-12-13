'use strict';

import '@inc2734/dispatch-custom-resize-event';
import SidebarStickyWidgetArea from './module/_sidebar-sticky-widget-area';

document.addEventListener(
  'DOMContentLoaded',
  () => new SidebarStickyWidgetArea(),
  false
);
