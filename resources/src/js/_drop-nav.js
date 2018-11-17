'use strict';

export default class SnowMonkeyDropNav {
  constructor() {
    this.defaultWindowWidth = window.innerWidth;

    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.header = document.getElementsByClassName('l-header');
    if (1 > this.header.length) {
      return;
    }
    this.header = this.header[0];

    this.dropNavWrapper = document.getElementsByClassName('l-header__drop-nav');
    if (1 > this.dropNavWrapper.length) {
      return;
    }
    this.dropNavWrapper = this.dropNavWrapper[0];

    this.dropNav = this.dropNavWrapper.querySelector('.p-global-nav');
    if (! this.dropNav) {
      return;
    }

    this.gnav = document.querySelector('[data-has-global-nav="true"] .p-global-nav');
    if (! this.gnav) {
      return;
    }

    if (this._isUpdateVisibility()) {
      this._gnav();
    }

    (() => {
      this.timer = null;
      window.addEventListener('scroll', () => this._scroll(), false);
    })();

    window.addEventListener('resize', () => this._resize(), false);
  }

  _scroll() {
    clearTimeout(this.timer);
    this.timer = setTimeout(() => {
      if (window.matchMedia('(min-width: 1023px)').matches) {
        if (this.header.offsetHeight + this.header.getBoundingClientRect().top + this._scrollTop() < this._scrollTop()) {
          if (this._isUpdateVisibility()) {
            this._dropNav();
            return;
          }
        }
      }

      if (this._isUpdateVisibility()) {
        this._gnav();
      }
    }, 100);
  }

  _resize() {
    if (window.innerWidth !== this.defaultWindowWidth) {
      if (this._isUpdateVisibility()) {
        this._gnav();
      }
    }
  }

  _isUpdateVisibility() {
    return false === snow_monkey_header_position_only_mobile ? false : true;
  }

  _scrollTop() {
    return document.documentElement.scrollTop || document.body.scrollTop;
  }

  _gnav() {
    this._showGnav();
    this._hideDropNav();
  }

  _dropNav() {
    this._hideGnav();
    this._showDropNav();
  }

  _showGnav() {
    this._show(this.gnav);
  }

  _hideGnav() {
    this._hide(this.gnav);
  }

  _showDropNav() {
    this._show(this.dropNavWrapper);
    this._show(this.dropNav);
  }

  _hideDropNav() {
    this._hide(this.dropNavWrapper);
    this._hide(this.dropNav);
  }

  _show(target) {
    target.setAttribute('aria-hidden', 'false');
  }

  _hide(target) {
    target.setAttribute('aria-hidden', 'true');
  }
}
