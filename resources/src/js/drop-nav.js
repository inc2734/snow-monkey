import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';
import { getHeader, getDropNavWrapper, hide, show } from './module/_helper';

const apply = (dropNavWrapper, header) => {
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

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header = getHeader();
    const dropNavWrapper = getDropNavWrapper();
    const gnav = document.querySelector('[data-has-global-nav="true"] .p-global-nav');

    if (! header || ! dropNavWrapper || ! gnav) {
      return;
    }

    if ('undefined' === typeof IntersectionObserver) {
      return;
    }

    window.addEventListener('load', () => apply(dropNavWrapper, header), false);
  },
  false
);
