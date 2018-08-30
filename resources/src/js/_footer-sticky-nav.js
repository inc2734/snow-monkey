'use strict';

export default class SnowMonkeyFooterStickyNav {
  constructor() {
    window.addEventListener('DOMContentLoaded', () => this._init(), false);
  }

  _init() {
    this.nav = document.getElementById('footer-sticky-nav');
    if (1 > this.nav.length) {
      return;
    }

    window.addEventListener('load', () => this._setPosition(), false);
    window.addEventListener('resize', () => this._setPosition(), false);
  }

  _setPosition() {
    const display = window.getComputedStyle(this.nav).getPropertyValue('display');
    const body    = document.getElementById('body');

    body.style.marginBottom = 'none' !== display ? `${this.nav.offsetHeight}px` : '';
  }
}
