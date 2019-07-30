'use strict';

import PageTopBtn from './module/_pagetop-btn.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const pageTop = document.querySelector('.c-page-top');
    pageTop && new PageTopBtn(pageTop);
  },
  false
);
