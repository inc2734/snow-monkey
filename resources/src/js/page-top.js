'use strict';

import { getFooterStickyNav, setStyle, getStyle, hide, show } from './module/_helper';

window.addEventListener(
  'load',
  () => {
    if ('undefined' === typeof IntersectionObserver) {
      return;
    }

    const pageTop = document.getElementById('page-top');
    if (! pageTop) {
      return;
    }

    const sensor = document.getElementById('page-top-sensor');
    if (! sensor) {
      return;
    }

    const options = {
      root: null,
      rootMargin: "0px",
      threshold: 0,
    };

    const toggle = isIntersecting => ! isIntersecting
      ? show(pageTop)
      : hide(pageTop);
    const callback = (entries) => entries.forEach(entry => toggle(entry.isIntersecting));
    const observer = new IntersectionObserver(callback, options);
    observer.observe(sensor);

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
