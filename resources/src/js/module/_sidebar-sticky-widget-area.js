'use strict';

import '@inc2734/dispatch-custom-resize-event';

import {
  getStyle,
  setStyle,
  getScrollOffset,
} from './_helper';

export function sidebarStickyWidgetArea(target, header) {
  const isSticky       = 'sticky' === getStyle(target, 'position');
  const targetMargin   = parseInt(getStyle(target, 'margin-top'));
  const headerPosition = getStyle(header, 'position');
  const offset         = getScrollOffset({ forceDropNav: true });

  const setTopMargin = () => {
    // Patch for some reason because reflection of header position is delayed
    const headerPosition = getStyle(header, 'position');
    'fixed' === headerPosition && headerPosition !== headerPosition && init();

    const prev = target.previousElementSibling;
    const measurement = (() => {
      if (prev) {
        const rect = prev.getBoundingClientRect();
        return rect.y + rect.height;
      }
      return target.parentNode.getBoundingClientRect().y;
    })();

    measurement <= offset && setStyle(target, 'top', `${ offset }px`);
  };

  if (! isSticky) {
    window.removeEventListener('scroll', setTopMargin, false);
    setStyle(target, 'top', '');
  } else {
    window.addEventListener('scroll', setTopMargin, false);
  }
}
