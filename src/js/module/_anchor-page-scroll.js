import {
  getScrollOffset,
} from './_helper';

export function anchorPageScroll() {
  const hash = window.location.hash;
  if (! hash) {
    return;
  }

  const target = document.querySelector(hash);
  if (! target) {
    return;
  }

  const y = window.pageYOffset + target.getBoundingClientRect().top;
  window.scrollTo(0, y - getScrollOffset());
};
