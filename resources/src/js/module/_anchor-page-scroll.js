'use strict';

import {
  scrollTop,
  getScrollOffset,
} from './_helper';

export function anchorPageScroll(header) {
  window.scrollTo(0, scrollTop() - getScrollOffset());
};
