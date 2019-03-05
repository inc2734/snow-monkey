'use strict';

import addCustomEvent from '@inc2734/add-custom-event';
import {getHeader, getDropNavWrapper, scrollTop, isHeaderPositionOnlyMobile, maybeShowDropNav} from './_helper.js';

export default class DropNav {
  constructor() {
    this.defaultWindowWidth = window.innerWidth;

    this.header = getHeader();
    if (! this.header) {
      return;
    }

    this.dropNavWrapper = getDropNavWrapper();
    if (! this.dropNavWrapper) {
      return;
    }

    this.gnav = document.querySelector('[data-has-global-nav="true"] .p-global-nav');
    if (! this.gnav) {
      return;
    }

    if (isHeaderPositionOnlyMobile()) {
      this._gnav();
    } else {
      this._hideDropNav();
    }

    this.timer = null;
    window.addEventListener('scroll', () => this._scroll(), false);
    window.addEventListener('resize', () => this._resize(), false);
  }

  _scroll() {
    clearTimeout(this.timer);
    this.timer = setTimeout(() => {
      if (maybeShowDropNav()) {
        this._dropNav();
        return;
      }

      if (isHeaderPositionOnlyMobile()) {
        this._gnav();
      }
    }, 100);
  }

  _resize() {
    if (window.innerWidth !== this.defaultWindowWidth) {
      if (isHeaderPositionOnlyMobile()) {
        this._gnav();
      }
    }
  }

  _gnav() {
    if ('false' === this.gnav.getAttribute('aria-hidden')) {
      return;
    }

    this._showGnav();
    this._hideDropNav();
  }

  _dropNav() {
    if ('false' === this.dropNavWrapper.getAttribute('aria-hidden')) {
      return;
    }

    this._hideGnav();
    this._showDropNav();
    addCustomEvent(window, 'showDropNav');
  }

  _showGnav() {
    this._show(this.gnav);
  }

  _hideGnav() {
    this._hide(this.gnav);
  }

  _showDropNav() {
    this._show(this.dropNavWrapper);
  }

  _hideDropNav() {
    this._hide(this.dropNavWrapper);
  }

  _show(target) {
    target.setAttribute('aria-hidden', 'false');
  }

  _hide(target) {
    target.setAttribute('aria-hidden', 'true');
  }
}
