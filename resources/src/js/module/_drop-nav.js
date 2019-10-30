'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';
import { scrollTop, isHeaderPositionOnlyMobile, maybeShowDropNav } from './_helper';

const hide = (target) => target.setAttribute('aria-hidden', 'true');
const show = (target) => target.setAttribute('aria-hidden', 'false');

export const GlobalNav = (gnav) => {
  window.addEventListener('showDropNav', () => hide(gnav));
  window.addEventListener('hideDropNav', () => show(gnav));
};

export const DropNav = (dropNavWrapper) => {
  let timer = null;

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

  const scrol = () => {
    clearTimeout(timer);
    timer = setTimeout(() => maybeShowDropNav() ? showDropNav() : hideDropNav(), 100);
  };

  hideDropNav();
  if (isHeaderPositionOnlyMobile()) {
    window.addEventListener('resize:width', () => hideDropNav(), false);
    window.addEventListener('scroll', () => scrol(), false);
  }
};
