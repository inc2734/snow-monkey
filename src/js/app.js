import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import { scrollChecker } from './module/_scroll-checker';

import {
  getAdminbar,
  getHeader,
  getDropNavWrapper,
  getHtml,
  getStyle,
  getTargetOffsetTop,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    scrollChecker(getHtml());

    const hash = window.location.hash;
    if (! hash) {
      return;
    }

    const header = getHeader();
    if (! header) {
      return;
    }

    const dropNav = getDropNavWrapper();
    const adminbar = getAdminbar();

    const showHeaderWithScroll = () => {
      window.removeEventListener('scroll', showHeaderWithScroll, false);
      header.removeAttribute('aria-hidden');
    };

    const hideHeaderWithLocationHash = () => {
      const targetOffsetTop = Math.floor(getTargetOffsetTop());
      const pageYOffset = Math.floor(window.pageYOffset);

      // If there is a control bar, shift it by that amount.
      if (!! adminbar) {
        const adminbarHeight = Math.floor(adminbar.offsetHeight);
        const adminbarOffsetTop = Math.floor(adminbar.getBoundingClientRect().top + window.pageYOffset);
        const adminbarOffsetBottom = Math.floor(adminbarOffsetTop + adminbarHeight);
        const isOverlap = targetOffsetTop >= adminbarOffsetTop && targetOffsetTop < adminbarOffsetBottom;
        if (isOverlap) {
          window.scrollTo(0, pageYOffset - adminbarHeight);
        }
      }

      const headerCssPosition = getStyle(header, 'position');
      const isNormalHeaderPosition = 'absolute' !== headerCssPosition
                                  && 'sticky' !== headerCssPosition
                                  && 'fixed' !== headerCssPosition && ! dropNav;
      if (
        isNormalHeaderPosition
        || header.offsetWidth < window.innerWidth
      ) {
        window.removeEventListener('scroll', hideHeaderWithLocationHash, false);
        header.removeAttribute('aria-hidden');
        return;
      }

      window.removeEventListener('scroll', hideHeaderWithLocationHash, false);
      header.setAttribute('aria-hidden', 'true');
      setTimeout(
        () => {
          window.addEventListener('scroll', showHeaderWithScroll, false);
        },
        500
      );
    };
    window.addEventListener('scroll', hideHeaderWithLocationHash, false);
  },
  false
);

document.addEventListener(
  'DOMContentLoaded',
  () => {
    new Spider( '.c-entries-carousel' );
  },
  false
);
