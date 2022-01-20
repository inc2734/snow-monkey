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

    if (header.offsetWidth < html.offsetWidth) {
      console.log('header.offsetWidth < html.offsetWidth');
      return;
    }

    let targetOffsetTop = getTargetOffsetTop();
    if (false !== targetOffsetTop) {
      targetOffsetTop = Math.floor(targetOffsetTop);
      const headerOffsetBottom = Math.floor(header.getBoundingClientRect().top + header.offsetHeight);
      if (targetOffsetTop < headerOffsetBottom) {
        return;
      }
    }

    const showHeaderWithScroll = () => {
      console.log('showHeaderWithScroll');
      window.removeEventListener('scroll', showHeaderWithScroll, false);
      header.removeAttribute('aria-hidden');
    };

    const hideHeaderWithLocationHash = () => {
      console.log('hideHeaderWithLocationHash');
      const pageYOffset = Math.floor(window.pageYOffset);

      const dropNav = getDropNavWrapper();
      const headerCssPosition = getStyle(header, 'position');
      const isNormalHeaderPosition = 'absolute' !== headerCssPosition
                                  && 'sticky' !== headerCssPosition
                                  && 'fixed' !== headerCssPosition && ! dropNav;

      if (isNormalHeaderPosition) {
        window.removeEventListener('scroll', hideHeaderWithLocationHash, false);
        header.removeAttribute('aria-hidden');
        return;
      }

      header.setAttribute('aria-hidden', 'true');

      if (25 > Math.abs(targetOffsetTop - pageYOffset)) {
        return;
      }

      window.removeEventListener('scroll', hideHeaderWithLocationHash, false);
      window.addEventListener('scroll', showHeaderWithScroll, false);
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
