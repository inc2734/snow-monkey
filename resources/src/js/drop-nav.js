'use strict';

import { getHeader, getDropNavWrapper } from './module/_helper';
import { DropNav, GlobalNav } from './module/_drop-nav';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header = getHeader();
    const dropNavWrapper = getDropNavWrapper();
    const gnav = document.querySelector('[data-has-global-nav="true"] .p-global-nav');

    if (! header || ! dropNavWrapper || ! gnav) {
      return;
    }

    DropNav(dropNavWrapper, header);
    GlobalNav(gnav);
  },
  false
);
