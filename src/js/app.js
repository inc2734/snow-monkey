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
    const headerCssPosition = getStyle(header, 'position');
    const isNormalHeaderPosition = 'absolute' !== headerCssPosition && 'sticky' !== headerCssPosition && 'fixed' !== headerCssPosition && ! dropNav;
    if (
      isNormalHeaderPosition
      || header.offsetWidth < window.innerWidth
    ) {
      return;
    }

    const apply = () => {
      const targetOffsetTop = Math.floor(getTargetOffsetTop());
      let pageYOffset = Math.floor(window.pageYOffset);
      let adminbarHeight = 0;

      // If there is a control bar, shift it by that amount.
      const adminbar = getAdminbar();
      if (!! adminbar) {
        adminbarHeight = Math.floor(adminbar.offsetHeight);
        const adminbarOffsetTop = Math.floor(adminbar.getBoundingClientRect().top + window.pageYOffset);
        const adminbarOffsetBottom = Math.floor(adminbarOffsetTop + adminbarHeight);
        const isOverlap = targetOffsetTop >= adminbarOffsetTop && targetOffsetTop < adminbarOffsetBottom;
        if (isOverlap) {
          window.scrollTo(0, pageYOffset - adminbarHeight);
          pageYOffset = Math.floor(window.pageYOffset);
        }
      }

      if (1 < Math.abs(targetOffsetTop - pageYOffset - adminbarHeight)) {
        setTimeout(
          () => {
            window.removeEventListener('scroll', apply, false);
            header.removeAttribute('aria-hidden');
          },
          500
        );
      } else {
        header.setAttribute('aria-hidden', 'true');
      }
    };
    window.addEventListener('scroll', apply, false);
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
