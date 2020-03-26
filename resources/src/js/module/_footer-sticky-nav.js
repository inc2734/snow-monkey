'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

export function applyFooterStickyNav(nav) {
  const init = () => addCustomEvent(nav, 'initFooterStickyNav');
  const onResize = () => init();
  const onResizeHeightUndo = () => nav.setAttribute('data-clickable', 'true');
  const onResizeHeightUpdate = () => nav.setAttribute('data-clickable', 'false');

  window.addEventListener('resize', onResize, false);
  window.addEventListener('resize:height:undo', onResizeHeightUndo, false);
  window.addEventListener('resize:height:ios', onResizeHeightUpdate, false);

  const pageEnd = document.getElementById('page-end');
  if (! pageEnd || 'undefined' === typeof IntersectionObserver) {
    return;
  }

  const onLoad = () => {
    init();

    let isFirstIntersecting = true;

    const observerCallback = (entries) => {
      const updateVisibility = (entry) => {
        if (isFirstIntersecting) {
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
      };

      entries.forEach(updateVisibility);
    };

    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0,
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    observer.observe(pageEnd);
  };

  window.addEventListener('load', onLoad, false);
}
