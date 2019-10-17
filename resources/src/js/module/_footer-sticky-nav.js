'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

export const FooterStickyNav = (nav) => {
  if (! nav) {
    return;
  }

  const init = (nav) => addCustomEvent(nav, 'initFooterStickyNav');
  const onResize = (nav) => init(nav);
  const onResizeHeightUndo = (nav) => nav.setAttribute('data-clickable', 'true');
  const onResizeHeightUpdate = (nav) => nav.setAttribute('data-clickable', 'false');

  window.addEventListener('resize', () => onResize(nav), false);
  window.addEventListener('resize:height:undo', () => onResizeHeightUndo(nav), false);
  window.addEventListener('resize:height:ios', () => onResizeHeightUpdate(nav), false);

  const pageEnd = document.getElementById('page-end');
  if (! pageEnd || 'undefined' === typeof IntersectionObserver) {
    return;
  }

  const onLoad = (nav) => {
    init(nav);

    const observerCallback = (entries) => {
      entries.forEach(
        (entry) => {
          const oldAriaHidden = nav.getAttribute('aria-hidden');
          const newAriaHidden = entry.isIntersecting ? 'true' : 'false';
          if (oldAriaHidden !== newAriaHidden) {
            nav.setAttribute('aria-hidden', newAriaHidden);
            addCustomEvent(nav, 'initFooterStickyNav');
          }
        }
      );
    };

    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0,
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    observer.observe(pageEnd);
  };

  window.addEventListener('load', () => onLoad(nav), false);
};
