'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

import { activeMenu } from './module/_active-menu';
import { getFooterStickyNav, hide, show } from './module/_helper';

const init = (nav) => addCustomEvent(nav, 'initFooterStickyNav');

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const nav = getFooterStickyNav();
    if (! nav) {
      return;
    }

    const links = nav.getElementsByTagName('a');

    const applyActiveMenu = (atag) => {
      const params = {
        home_url: snow_monkey.home_url,
      };
      activeMenu(atag, params);
    };

    forEachHtmlNodes(links, applyActiveMenu);

    const handleResize = () => init(nav);
    const handleResizeHeightUndo = () => nav.setAttribute('data-clickable', 'true');
    const handleResizeHeightUpdate = () => nav.setAttribute('data-clickable', 'false');

    window.addEventListener('resize', handleResize, false);
    window.addEventListener('resize:height:undo', handleResizeHeightUndo, false);
    window.addEventListener('resize:height:ios', handleResizeHeightUpdate, false);

    const pageEnd = document.getElementById('page-end');
    if (!! pageEnd && 'undefined' !== typeof IntersectionObserver) {
      const handleLoad = () => {
        init(nav);

        let isFirstIntersecting = true;

        const observerCallback = (entries) => {
          const updateVisibility = (entry) => {
            // @todo Required to set the display position of the footer CTA
            if (isFirstIntersecting) {
              isFirstIntersecting = false;
              return;
            }

            const oldAriaHidden = nav.getAttribute('aria-hidden');
            if (entry.rootBounds.height <= entry.boundingClientRect.y) {
              if ('false' !== oldAriaHidden) {
                show(nav);
                addCustomEvent(nav, 'initFooterStickyNav');
              }
            } else {
              if ('true' !== oldAriaHidden) {
                hide(nav);
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

      window.addEventListener('load', handleLoad, false);
    }
  },
  false
);
