'use strict';

import PageTopBtn from './module/_pagetop-btn.js';

document.addEventListener(
  'DOMContentLoaded',
  () => new PageTopBtn(document.querySelector('.c-page-top')),
  false
);
