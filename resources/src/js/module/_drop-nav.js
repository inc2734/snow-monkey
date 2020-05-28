'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

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

  const handleDisplayPageWithAnchorLink = () => {
    window.removeEventListener('scroll', handleScroll, false);
    !! window.location.hash && hideDropNav();
  };

  const ovserverOptions = {}
  ovserverOptions.root = null;
  ovserverOptions.rootMargin = '0px';
  ovserverOptions.threshold = 0;
  const toggle = (isIntersecting) => isIntersecting ? hideDropNav() : showDropNav();
  const callback = (entries) => entries.forEach(entry => toggle(entry.isIntersecting));
  const observer = new IntersectionObserver(callback, ovserverOptions);
  const startObserver = () => observer.observe(header);
  const stopObserver = () => observer.unobserve(header);
  const handleScrollForObserver = () => {
    window.removeEventListener('scroll', handleScrollForObserver, false);
    startObserver();
  };
  const restartObserver = () => {
    stopObserver();
    setTimeout(() => {
      window.addEventListener('scroll', handleScrollForObserver, false);
    }, 2000);
  };

  const handleScroll = () => {
    handleDisplayPageWithAnchorLink();
    startObserver();
  };

  hideDropNav();
  window.addEventListener('resize:width', hideDropNav, false);
  window.addEventListener('scroll', handleScroll, false);

  const links = document.querySelectorAll('a[href*="#"]');
  const handleClick = () => {
    hideDropNav();
    restartObserver();
  };
  const hideDropNavWithClickAnchorLink = (link) => addEventListener('click', handleClick, false);
  forEachHtmlNodes(links, hideDropNavWithClickAnchorLink);
};
