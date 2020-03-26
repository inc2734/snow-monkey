'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

const init = (nav) => addCustomEvent(nav, 'initFooterStickyNav');
export const onResize = init;
export const onResizeHeightUndo = (nav) => nav.setAttribute('data-clickable', 'true');
export const onResizeHeightUpdate = (nav) => nav.setAttribute('data-clickable', 'false');

export const onLoad = (nav) => {
  const pageEnd = document.getElementById('page-end');
  if (! pageEnd || 'undefined' === typeof IntersectionObserver) {
    return;
  }

  init(nav);

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
