'use strict';

import { stickyHeader } from './module/_sticky-header';

import {
  getHeader,
  getContents,
} from './module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const header   = getHeader();
    const contents = getContents();

    if (! header || ! contents) {
      return;
    }

    stickyHeader(header, contents);
  },
  false
);
