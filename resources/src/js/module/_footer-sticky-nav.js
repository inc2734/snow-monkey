'use strict';

import {getBody, getFooterStickyNav, getStyle, setStyle} from './_helper.js';

export default class FooterStickyNav {
  constructor() {
    this.nav = getFooterStickyNav();
    if (! this.nav) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this.navDefaultPaddingBottom = getStyle(this.nav, 'padding-bottom');

    window.addEventListener('load', () => this._init(), false);
    window.addEventListener('resize', () => this._resize(), false);
  }

  _init() {
    const display = getStyle(this.nav, 'display');
    const hidden  = this.nav.getAttribute('aria-hidden');
    const body    = getBody();

    setStyle(body, 'marginBottom', `${this.nav.offsetHeight}px`);
  }

  _resize() {
    this._updateNavHidden();

    if (window.innerWidth === this.defaultWindowWidth) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this._init();
  }

  _updateNavHidden() {
    if (this.navDefaultPaddingBottom !== getStyle(this.nav, 'padding-bottom')) {
      this.nav.setAttribute('aria-hidden', 'true');
    } else {
      this.nav.setAttribute('aria-hidden', 'false');
    }
  }
}
