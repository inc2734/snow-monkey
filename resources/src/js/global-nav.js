'use strict';

import SnowMonkeyActiveMenu from './module/_active-menu.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    new SnowMonkeyActiveMenu(
      '.p-global-nav',
      {
        home_url: snow_monkey.home_url,
      }
    );
  }
);
