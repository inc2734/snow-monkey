'use strict';

import { fixAdminbar } from './module/_fix-adminbar';

import {
  getHeader,
  getAdminbar,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header   = getHeader();
    const adminbar = getAdminbar();

    if ( ! header || ! adminbar) {
      return;
    }

    fixAdminbar(header, adminbar);
  },
  false
);
