import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis';

import { anchorPageScroll } from './module/_anchor-page-scroll';
import { scrollChecker } from './module/_scroll-checker';

import {
  getHeader,
  getHtml,
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

    const apply = () => {
      window.removeEventListener('scroll', apply, false);
      setTimeout(
        () => anchorPageScroll(header),
        0
      );
    };

    window.addEventListener('scroll', apply, false);

    new Spider( '.c-entries-carousel' );
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
