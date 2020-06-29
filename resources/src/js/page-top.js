import {
  getFooterStickyNav,
  setStyle,
  getStyle,
  hide,
  show,
  throttle,
  isPassiveSupported
} from './module/_helper';

window.addEventListener(
  'load',
  () => {
    const pageTop = document.getElementById('page-top');
    if (! pageTop) {
      return;
    }

    let ariaHidden = pageTop.getAttribute('aria-hidden');

    const handleScroll = throttle(
      () => {
        if (500 <= window.pageYOffset) {
          if ('false' !== ariaHidden) {
            show(pageTop);
            ariaHidden = 'false';
          }
        } else {
          if ('true' !== ariaHidden) {
            hide(pageTop);
            ariaHidden = 'true';
          }
        }
      },
      150
    );

    window.addEventListener('scroll', handleScroll, isPassiveSupported() ? { passive: true } : false);

    const footerStickyNav = getFooterStickyNav();
    if (! footerStickyNav) {
      return;
    }

    const defaultPosition = getStyle(pageTop, 'bottom');

    footerStickyNav.addEventListener(
      'initFooterStickyNav',
      () => {
        setTimeout(
          () => {
            const isOverlapping = parseInt(defaultPosition) < parseInt(footerStickyNav.offsetHeight);
            const bottom = isOverlapping ? `${footerStickyNav.offsetHeight}px` : '';
            setStyle(pageTop, 'bottom', bottom);
          },
          100
        );
      }
    );
  },
  false
);
