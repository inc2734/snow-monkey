'use strict';

import {getDrawerNav} from './_helper.js';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import BasisDrawerCloseZone from '../../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer-close-zone.js';
import BasisDrawer from '../../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/_drawer.js';

export default class HashNav {
  constructor(link) {
    this.drawer = getDrawerNav();
    if (! this.drawer) {
      return;
    }

    link.addEventListener(
      'click',
      (event) => {
        event.stopPropagation();
        this._click();
        return false
      },
      false
    );
  }

  _click() {
    if ('false' === this.drawer.getAttribute('aria-hidden')) {
      BasisDrawer.close(this.drawer);
    } else {
      BasisDrawer.open(this.drawer);
    }
  }
}
