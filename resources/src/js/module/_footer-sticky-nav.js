'use strict';

import addCustomEvent from '@inc2734/add-custom-event';
import {getBody, getStyle, setStyle} from './_helper.js';

let defaultWindowWidth  = window.innerWidth;
let defaultWindowHeight = window.innerHeight;

const init = (nav) => addCustomEvent(nav, 'initFooterStickyNav');
const onLoad = (nav) => init(nav);
const onResize = (nav) => window.innerWidth !== defaultWindowWidth ? resize(nav) : toggleBars(nav);
const toggleBars = (nav) => updateClickable(nav);

const resize = (nav) => {
  defaultWindowWidth  = window.innerWidth;
  defaultWindowHeight = window.innerHeight;
  init(nav);
};

const updateClickable = (nav) => {
  const oldClickable = nav.getAttribute('data-clickable');
  const newClickable = window.innerHeight === defaultWindowHeight;
  if (oldClickable !== newClickable) {
    nav.setAttribute('data-clickable', newClickable);
    init();
  }
};

const addBodyMargin = (nav) => {
  const hidden = nav.getAttribute('aria-hidden');
  const body   = getBody();

  const marginBottom = 'true' === nav.getAttribute('aria-hidden') ? '' : `${nav.offsetHeight}px`;
  setStyle(body, 'marginBottom', marginBottom);
};

export const FooterStickyNav = (nav) => {
  if (! nav) {
    return;
  }

  window.addEventListener('load', () => onLoad(nav), false);
  window.addEventListener('resize', () => onResize(nav), false);
  nav.addEventListener('initFooterStickyNav', () => addBodyMargin(nav), false);
};
