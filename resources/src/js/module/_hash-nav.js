'use strict';

import { getDrawerNav } from './_helper';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import BasisDrawerCloseZone from '../../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer-close-zone';
import BasisDrawer from '../../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer';

export function hashNav(event) {
  const drawer = getDrawerNav();
  if (! drawer) {
    return;
  }

  event.stopPropagation();

  if ('false' === drawer.getAttribute('aria-hidden')) {
    BasisDrawer.close(drawer);
  } else {
    BasisDrawer.open(drawer);
  }

  return false;
}
