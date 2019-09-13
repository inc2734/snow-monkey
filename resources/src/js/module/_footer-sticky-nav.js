'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

export const FooterStickyNav = (nav) => {
  if (! nav) {
    return;
  }

  const init = (nav) => addCustomEvent(nav, 'initFooterStickyNav');
  const onLoad = (nav) => init(nav);
  const onResize = (nav) => init(nav);
  const onResizeHeightUndo = (nav) => nav.setAttribute('data-clickable', 'true');
  const onResizeHeightUpdate = (nav) => nav.setAttribute('data-clickable', 'false');

  window.addEventListener('load', () => onLoad(nav), false);
  window.addEventListener('resize', () => onResize(nav), false);
  window.addEventListener('resize:height:undo', () => onResizeHeightUndo(nav), false);
  window.addEventListener('resize:height:ios', () => onResizeHeightUpdate(nav), false);
};
