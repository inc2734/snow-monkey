import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import { scrollChecker } from './module/_scroll-checker';

import {
  getHeader,
  getDropNavWrapper,
  getHtml,
  getStyle,
  getTargetOffsetTop,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const html = getHtml();
    scrollChecker(html);

    const hash = window.location.hash;
    if (! hash) {
      return;
    }

    const header = getHeader();
    if (! header) {
      return;
    }

    const dropNav = getDropNavWrapper();

    const showHeaderWithScroll = () => {
      window.removeEventListener('scroll', showHeaderWithScroll, false);
      header.removeAttribute('aria-hidden');
    };

    const hideHeaderWithLocationHash = () => {
      const targetOffsetTop = Math.floor(getTargetOffsetTop());
      const pageYOffset = Math.floor(window.pageYOffset);

      const headerCssPosition = getStyle(header, 'position');
      const isNormalHeaderPosition = 'absolute' !== headerCssPosition
                                  && 'sticky' !== headerCssPosition
                                  && 'fixed' !== headerCssPosition && ! dropNav;
      if (
        isNormalHeaderPosition
        || header.offsetWidth < html.offsetWidth
      ) {
        window.removeEventListener('scroll', hideHeaderWithLocationHash, false);
        header.removeAttribute('aria-hidden');
        return;
      }

      header.setAttribute('aria-hidden', 'true');

      if (50 > Math.abs(targetOffsetTop - pageYOffset)) {
        return;
      }

      window.removeEventListener('scroll', hideHeaderWithLocationHash, false);
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
