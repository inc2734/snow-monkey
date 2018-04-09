'use strict';

import $ from 'jquery';

export default class SnowMonkeyDropNav {
  constructor() {
    $(() => {
      this.header = $('.l-header');
      this.nav    = $('.l-header__drop-nav');
      this.min    = 1023;
      this.defaultWindowWidth = $(window).width();
      this.gNavClass = '.p-global-nav';

      this._showGnav();

      this.onScroll();
      this.onResize();
    });
  }

  onScroll() {
    $(window).scroll(() => {
      if (this.min < $(window).width()) {
        if (this.header.outerHeight() < $(window).scrollTop()) {
          this._showDropNav();
          return;
        }
      }

      this._showGnav();
    });
  }

  onResize() {
    $(window).resize(() => {
      if ($(window).width() === this.defaultWindowWidth) {
        return;
      }

      this._showGnav();
    });
  }

  _showGnav() {
    if ('sticky' === this.header.attr('data-l-header-type') && false === snow_monkey_header_position_only_mobile) {
      return;
    }

    $(this.gNavClass).attr('aria-hidden', 'false');
    this.nav.attr('aria-hidden', 'true');
    this.nav.find(this.gNavClass).attr('aria-hidden', 'true');
  }

  _showDropNav() {
    if ('sticky' === this.header.attr('data-l-header-type') && false === snow_monkey_header_position_only_mobile) {
      return;
    }

    $(this.gNavClass).attr('aria-hidden', 'true');
    this.nav.attr('aria-hidden', 'false');
    this.nav.find(this.gNavClass).attr('aria-hidden', 'false');
  }
}
