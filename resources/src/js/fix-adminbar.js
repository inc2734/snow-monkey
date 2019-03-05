'use strict';

import FixAdminBar from './module/_fix-adminbar.js';

window.addEventListener(
  'DOMContentLoaded',
  () => {
    new FixAdminBar();
  },
  false
);
