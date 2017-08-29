'use strict';

import $ from 'jquery';

export default class SnowMonkeyDropNav {
  constructor() {
    $(() => {
      this.header = $('.l-header');
      this.nav    = $('.l-header__drop-nav');
      this.min    = 1023;
      this.defaultWindowWidth = $(window).width();

      this.onScroll();
      this.onResize();
    });
  }

  onScroll() {
    $(window).scroll(() => {
      if (this.min < $(window).width()) {
        if (this.header.outerHeight() < $(window).scrollTop()) {
          this.nav.attr('aria-hidden', 'false');
          return;
        }
      }

      this.nav.attr('aria-hidden', 'true');
    });
  }

  onResize() {
    $(window).resize(() => {
      if ($(window).width() === this.defaultWindowWidth) {
        return;
      }

      this.nav.attr('aria-hidden', 'true');
    });
  }
}
