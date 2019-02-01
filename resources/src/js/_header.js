'use strict';

import {getHeader, getContents, getDefaultHeaderPosition, setHeaderType, getStyle, setStyle, isHeaderPositionOnlyMobile} from './_helper.js';

export default class SnowMonkeyHeader {
  constructor() {
    if (! isHeaderPositionOnlyMobile()) {
      return;
    }

    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.header = getHeader();
    if (! this.header) {
      return;
    }

    this.contents = getContents();
    if (! this.contents) {
      return;
    }

    this.defaultType = getDefaultHeaderPosition();

    this._init();
    window.addEventListener('resize', () => this._init(), false);
  }

  _init() {
    if ('sticky' !== this.defaultType && 'overlay' !== this.defaultType) {
      return;
    }

    if (window.matchMedia('(min-width: 1023px)').matches) {
      setHeaderType('');
      setStyle(this.contents, 'marginTop', '');
    } else {
      setHeaderType(this.defaultType);
      const position = getStyle(this.header, 'position');
      if ('fixed' === position || 'absolute' === position) {
        if ('sticky' === this.defaultType) {
          setStyle(this.contents, 'marginTop', `${this.header.offsetHeight}px`);
        }
      }
    }
  }
}
