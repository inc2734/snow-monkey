import { SmoothScroll } from '@inc2734/smooth-scroll';
import { getScrollOffset } from './module/_helper';

window.addEventListener(
  'load',
  () => {
    [
      '.c-page-top a[href^="#"]',
      '.wpco a[href^="#"]',
      '.u-smooth-scroll[href*="#"]',
      '.u-smooth-scroll a[href*="#"]',
    ].forEach((selector) => {
      new SmoothScroll(
        {
          selector,
          offset: () => getScrollOffset(),
        }
      );
    } );
  },
  false
);
