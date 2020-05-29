'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

const hide = (target) => target.setAttribute('aria-hidden', 'true');
const show = (target) => target.setAttribute('aria-hidden', 'false');

export const applyGlobalNav = (gnav) => {
  window.addEventListener('showDropNav', () => hide(gnav));
  window.addEventListener('hideDropNav', () => show(gnav));
};

export const applyDropNav = (dropNavWrapper, header) => {
  if ('undefined' === typeof IntersectionObserver) {
    return;
  }

  const hideDropNav = () => {
    if ('false' === dropNavWrapper.getAttribute('aria-hidden')) {
      hide(dropNavWrapper);
      addCustomEvent(window, 'hideDropNav');
    }
  };

  const showDropNav = () => {
    if ('true' === dropNavWrapper.getAttribute('aria-hidden')) {
      show(dropNavWrapper);
      addCustomEvent(window, 'showDropNav');
    }
  };

  hideDropNav();
  window.addEventListener('resize:width', () => hideDropNav(), false);

  const options = {
    root: null,
    rootMargin: "0px",
    threshold: 0,
  };

  const toggle   = (isIntersecting) => isIntersecting ? hideDropNav() : showDropNav();
  const callback = (entries) => entries.forEach(entry => toggle(entry.isIntersecting));
  const observer = new IntersectionObserver(callback, options);
  observer.observe(header);
};
