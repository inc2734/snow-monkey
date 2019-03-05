'use strict';

import {getBody, getFooterStickyNav, getStyle, setStyle} from './_helper.js';

export default class FooterStickyNav {
  constructor() {
    this.nav = getFooterStickyNav();
    if (! this.nav) {
      return;
    }

    window.addEventListener('load', () => this._init(), false);
    window.addEventListener('resize', () => this._init(), false);
  }

  _init() {
    const display = getStyle(this.nav, 'display');
    const body    = getBody();

    setStyle(body, 'marginBottom', 'none' !== display ? `${this.nav.offsetHeight}px` : '');
  }
}
