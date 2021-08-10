import '@inc2734/dispatch-custom-resize-event';

import {
  getHeader,
  getAdminbar,
  setStyle,
  getStyle,
  getTargetOffsetTop,
  getHtml,
} from './module/_helper';

const apply = (header, adminbar) => {
  const setHeaderPosition = (position) => {
    setStyle(header, 'position', position);
  };

  const setHeaderTop = (top) => {
    top = null !== top ? `${ parseInt(top) }px` : top;
    setStyle(header, 'top', top);
  };

  const fixHeaderPosition = () => {
    if (window.pageYOffset > adminbar.offsetHeight) {
      setHeaderPosition(null);
      setHeaderTop(0);
    } else {
      setHeaderPosition('absolute');
      setHeaderTop(null);
    }
  };

  const html = getHtml();

  const init = () => {
    const headerPsition   = getStyle(header, 'position');
    const adminbarPsition = getStyle(adminbar, 'position');
    if ('fixed' !== adminbarPsition && 'fixed' === headerPsition && header.scrollHeight < html.offsetHeight) {
      window.addEventListener('scroll', fixHeaderPosition, false);
    } else {
      window.removeEventListener('scroll', fixHeaderPosition, false);
      setHeaderTop(null);
      setHeaderPosition(null);
    }
  };

  init();

  window.addEventListener('resize:width', init, false);
};

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header   = getHeader();
    const adminbar = getAdminbar();

    if ( ! header || ! adminbar) {
      return;
    }

    apply(header, adminbar);

     // If there is a control bar, shift it by that amount.
    const correctScrollPosition = () => {
      removeEventListener('scroll', correctScrollPosition, false);

      const targetOffsetTop = Math.floor(getTargetOffsetTop());

      if (! adminbar) {
        return;
      }

      const adminbarHeight = Math.floor(adminbar.offsetHeight);
      const adminbarOffsetTop = Math.floor(adminbar.getBoundingClientRect().top + window.pageYOffset);
      const adminbarOffsetBottom = Math.floor(adminbarOffsetTop + adminbarHeight);
      const isOverlap = targetOffsetTop >= adminbarOffsetTop && targetOffsetTop < adminbarOffsetBottom;
      if (isOverlap) {
        window.scrollTo(0, pageYOffset - adminbarHeight);
      }
    };
    addEventListener('scroll', correctScrollPosition, false);
  },
  false
);
