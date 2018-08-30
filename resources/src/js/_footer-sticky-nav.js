'use strict';

export default class SnowMonkeyFooterStickyNav {
  constructor() {
    this.nav = document.getElementById('footer-sticky-nav');
    if (1 > this.nav.length) {
      return;
    }

    window.addEventListener('DOMContentLoaded', () => this._init(), false);
    window.addEventListener('load', () => this._init(), false);
    window.addEventListener('resize', () => this._init(), false);
  }

  _init() {
    const display = window.getComputedStyle(this.nav).getPropertyValue('display');
    const body    = document.getElementById('body');

    body.style.marginBottom = 'none' !== display ? `${this.nav.offsetHeight}px` : '';
  }
}
