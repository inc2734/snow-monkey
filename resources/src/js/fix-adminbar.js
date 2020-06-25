import '@inc2734/dispatch-custom-resize-event';

import {
  getHeader,
  getAdminbar,
  scrollTop,
  setStyle,
  getStyle,
  hasClass,
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
    if (scrollTop() > adminbar.offsetHeight) {
      setHeaderPosition(null);
      setHeaderTop(0);
    } else {
      setHeaderPosition('absolute');
      setHeaderTop(null);
    }
  };

  const init = () => {
    const headerPsition   = getStyle(header, 'position');
    const adminbarPsition = getStyle(adminbar, 'position');
    if ('fixed' !== adminbarPsition && 'fixed' === headerPsition && header.scrollHeight < window.innerHeight) {
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
  },
  false
);
