'use strict';

export default class SnowMonkeyHeader {
  constructor() {
    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.header = document.getElementsByClassName('l-header');
    if (1 > this.header.length) {
      return;
    }

    this.contents = document.getElementsByClassName('l-contents');
    if (1 > this.contents.length) {
      return;
    }

    this.header      = this.header[0];
    this.contents    = this.contents[0];
    this.defaultType = this.header.getAttribute('data-snow-monkey-default-header-position');

    this._init();
    window.addEventListener('resize', () => this._init(), false);
  }

  _init() {
    if ('sticky' !== this.defaultType && 'overlay' !== this.defaultType) {
      return;
    }

    if (window.matchMedia('(min-width: 1023px)').matches) {
      this.header.setAttribute('data-l-header-type', '');
      this.contents.style.marginTop = '';
    } else {
      this.header.setAttribute('data-l-header-type', this.defaultType);
      const position = window.getComputedStyle(this.header).getPropertyValue('position');
      if ('fixed' === position || 'absolute' === position) {
        if ('sticky' === this.defaultType) {
          this.contents.style.marginTop = `${this.header.offsetHeight}px`;
        }
      }
    }
  }
}
