'use strict';

export default class SnowMonkeyFooterStickyNav {
  constructor() {
    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.nav = document.getElementById('footer-sticky-nav');
    if (! this.nav.length) {
      return;
    }

    window.addEventListener('load', () => this._init(), false);
    window.addEventListener('resize', () => this._init(), false);
  }

  _init() {
    const display = window.getComputedStyle(this.nav).getPropertyValue('display');
    const body    = document.getElementById('body');

    body.style.marginBottom = 'none' !== display ? `${this.nav.offsetHeight}px` : '';
  }
}
