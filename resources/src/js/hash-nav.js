'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import BasisDrawer from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer';

import { getDrawerNav } from './module/_helper';

const handleClickDrawerHashNav = (event) => {
  const drawer = getDrawerNav();
  if (! drawer) {
    return;
  }

  event.stopPropagation();

  'false' === drawer.getAttribute('aria-hidden')
    ? BasisDrawer.close(drawer)
    : BasisDrawer.open(drawer);

  return false;
}

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const drawerControlLinks = document.querySelectorAll('a[href="#sm-drawer"]');
    const applyDrawerHashNav = (link) => link.addEventListener('click', handleClickDrawerHashNav, false);
    forEachHtmlNodes(drawerControlLinks, applyDrawerHashNav);
  },
  false
);
