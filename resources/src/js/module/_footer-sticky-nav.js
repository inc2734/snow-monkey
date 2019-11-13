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

    let isFirstIntersecting = true;
    const observerCallback = (entries) => {
      entries.forEach(
        (entry) => {
          if (isFirstIntersecting && entry.isIntersecting) {
            isFirstIntersecting = false;
            return;
          }
          const oldAriaHidden = nav.getAttribute('aria-hidden');
          if (entry.rootBounds.height <= entry.boundingClientRect.y) {
            if ('false' !== oldAriaHidden) {
              nav.setAttribute('aria-hidden', 'false');
              addCustomEvent(nav, 'initFooterStickyNav');
            }
          } else {
            if ('true' !== oldAriaHidden) {
              nav.setAttribute('aria-hidden', 'true');
              addCustomEvent(nav, 'initFooterStickyNav');
            }
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
