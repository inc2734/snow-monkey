'use strict';

import $ from 'jquery';
import {getHeader, getDropNavWrapper, scrollTop, getHeaderType, maybeShowDropNav} from './_helper.js';

export default class SnowMonkeyAnchorPageScroll {
  constructor(selector, params = {}) {
    this.hash = window.location.hash;
    if (! this.hash) {
      return;
    }

    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.header = getHeader();
    if (! this.header) {
      return;
    }

    this.dropNavWrapper   = getDropNavWrapper();
    this.defaultScrollTop = scrollTop();
    this.scrolled = false;
    window.addEventListener('scroll', () => this._scrollEvent(), false);
  }

  _scrollEvent() {
    if (0 < this.defaultScrollTop) {
      return;
    }

    if (this.scrolled) {
      return;
    }
    this.scrolled = true;

    if (maybeShowDropNav() && !! this.dropNavWrapper) {
      this._scrollToTarget(this.dropNavWrapper.offsetHeight);
    } else if ('sticky' === getHeaderType() || 'overlay' === getHeaderType()) {
      this._scrollToTarget(this.header.offsetHeight);
    }
  }

  _scrollToTarget(y) {
    window.scrollTo(0, scrollTop() - y);
  }
}
