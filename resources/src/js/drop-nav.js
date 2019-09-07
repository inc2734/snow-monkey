'use strict';

import { getHeader, getDropNavWrapper } from './module/_helper.js';
import { DropNav, GlobalNav } from './module/_drop-nav.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header = getHeader();
    const dropNavWrapper = getDropNavWrapper();
    const gnav = document.querySelector('[data-has-global-nav="true"] .p-global-nav');

    if (! header || ! dropNavWrapper || ! gnav) {
      return;
    }

    DropNav(dropNavWrapper);
    GlobalNav(gnav);
  },
  false
);
