'use strict';

import $ from 'jquery';

export default class SnowMonkeyDropNav {
  constructor() {
    this.header = $('.l-header');
    this.nav    = $('.l-header__drop-nav');
    this.min    = 1023;
    this.defaultWindowWidth = $(window).width();
    this.gNavClass = '.p-global-nav';

    if (this._isUpdateVisibility()) {
      this._showGnav();
      this._hideDropNav();
    }

    this.onScroll();
    this.onResize();
  }

  onScroll() {
    $(window).scroll(() => {
      if (this.min < $(window).width()) {
        if (this.header.outerHeight() < $(window).scrollTop()) {
          if (this._isUpdateVisibility()) {
            this._hideGnav();
            this._showDropNav();
            return;
          }
        }
      }

      if (this._isUpdateVisibility()) {
        this._showGnav();
        this._hideDropNav();
      }
    });
  }

  onResize() {
    $(window).resize(() => {
      if ($(window).width() === this.defaultWindowWidth) {
        return;
      }

      if (this._isUpdateVisibility()) {
        this._showGnav();
        this._hideDropNav();
      }
    });
  }

  _isUpdateVisibility() {
    //if ('sticky' === this.header.attr('data-l-header-type') || 'overlay' === this.header.attr('data-l-header-type')) {
      if (false === snow_monkey_header_position_only_mobile) {
        return false;
      }
    //}

    return true;
  }

  _showGnav() {
    this._show($(this.gNavClass));
  }

  _hideGnav() {
    this._hide($(this.gNavClass));
  }

  _showDropNav() {
    this._show(this.nav);
    this._show(this.nav.find(this.gNavClass));
  }

  _hideDropNav() {
    this._hide(this.nav);
    this._hide(this.nav.find(this.gNavClass));
  }

  _show(target) {
    target.attr('aria-hidden', 'false');
  }

  _hide(target) {
    target.attr('aria-hidden', 'true');
  }
}
