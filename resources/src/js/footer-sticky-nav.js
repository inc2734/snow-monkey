'use strict';

import SnowMonkeyFooterStickyNav from './module/_footer-sticky-nav.js';
import SnowMonkeyActiveMenu from './module/_active-menu.js';

new SnowMonkeyFooterStickyNav();

document.addEventListener(
  'DOMContentLoaded',
  () => {
    new SnowMonkeyActiveMenu(
      '.p-footer-sticky-nav',
      {
        home_url: snow_monkey.home_url,
      }
    );
  },
  false
);
