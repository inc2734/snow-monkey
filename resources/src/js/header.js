'use strict';

import $ from 'jquery';

export default class SnowMonkeyHeader {
  constructor() {
    $(() => {
      this.min         = 1023;
      this.header      = $('.l-header');
      this.contents    = $('.l-contents');
      this.defaultType = this.header.attr('data-snow-monkey-default-header-position');

      this.init();

      $(window).resize(() => {
        this.init();
      });
    });
  }

  init() {
    if ('sticky' !== this.defaultType && 'overlay' !== this.defaultType) {
      return;
    }

    if (this.min < $(window).width()) {
      if ('sticky' === this.defaultType || 'overlay' === this.defaultType) {
        this.header.attr('data-l-header-type', '');
        this.contents.css('margin-top', '');
      }
    } else {
      this.header.attr('data-l-header-type', this.defaultType);
      if ('fixed' === this.header.css('position') || 'absolute' === this.header.css('position')) {
        if ('sticky' === this.defaultType) {
          const headerHeight = this.header.outerHeight();
          this.contents.css('margin-top', `${headerHeight}px`);
        }
      }
    }
  }
}
