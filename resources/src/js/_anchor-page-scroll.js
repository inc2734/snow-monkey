'use strict';

import $ from 'jquery';

export default class SnowMonkeyAnchorPageScroll {
  constructor(selector, params = {}) {
    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.hash = window.location.hash;
    if (! this.hash) {
      return;
    }

    this.header = document.getElementsByClassName('l-header');
    if (! this.header) {
      return;
    }
    this.header = this.header[0];

    this.dropNavWrapper = document.getElementsByClassName('l-header__drop-nav');
    if (! this.dropNavWrapper) {
      return;
    }
    this.dropNavWrapper = this.dropNavWrapper[0];

    if (0 < this._scrollTop()) {
      return;
    }

    this._init();
    window.addEventListener('resize', () => this._init(), false);
    window.addEventListener('showDropNav', () => this._init(), false);
  }

  _init() {
    const headerType = this.header.getAttribute('data-l-header-type');

    if ('false' === this.dropNavWrapper.getAttribute('aria-hidden')) {
      this._scrollTo(this._scrollTop() - this.dropNavWrapper.offsetHeight);
    } else if ('sticky' === headerType || 'overlay' === headerType) {
      this._scrollTo(this._scrollTop() - this.header.offsetHeight);
    }
  }

  _scrollTop() {
    return document.documentElement.scrollTop || document.body.scrollTop;
  }

  _scrollTo(y) {
    window.scrollTo(0, y)
  }
}
