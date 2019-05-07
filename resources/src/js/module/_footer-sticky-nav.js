'use strict';

import {getBody, getFooterStickyNav, getStyle, setStyle} from './_helper.js';

export default class FooterStickyNav {
  constructor() {
    this.nav = getFooterStickyNav();
    if (! this.nav) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;

    window.addEventListener('load', () => this._init(), false);
    window.addEventListener('resize', () => this._resize(), false);
    window.addEventListener('scroll', () => this._scroll(), false);
  }

  _init() {
    const display = getStyle(this.nav, 'display');
    const hidden  = this.nav.getAttribute('aria-hidden');
    const body    = getBody();

    setStyle(body, 'marginBottom', 'none' !== display && 'true' !== hidden ? `${this.nav.offsetHeight}px` : '');
  }

  _resize() {
    if (window.innerWidth !== this.defaultWindowWidth || ! this._visibleBrowserBar()) {
      this._init();
    }
  }

  _scroll() {
    this.nav.setAttribute('aria-hidden', this._visibleBrowserBar() ? 'false' : 'true');
  }

  _visibleBrowserBar() {
    return window.innerHeight === document.documentElement.clientHeight;
  }
}
