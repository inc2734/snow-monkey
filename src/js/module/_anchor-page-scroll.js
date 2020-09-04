import {
  getScrollOffset,
} from './_helper';

export function anchorPageScroll(header) {
  window.scrollTo(0, window.pageYOffset - getScrollOffset());
};
