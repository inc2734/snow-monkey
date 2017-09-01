'use strict';

import $ from 'jquery';

export default class SnowMonkeyHeader {
  constructor() {
    $(() => {
      this.min     = 1023;
      this.header  = $('.l-header');
      this.contents = $('.l-contents');

      this.init();

      $(window).resize(function() {
        this.init();
      });
    });
  }

  init() {
    if (this.min < $(window).width() && ! this.header.attr('data-l-header-type')) {
      this.header.attr('data-l-header-type', '');
      this.contents.css('margin-top', '');
    } else {
      this.header.attr('data-l-header-type', 'sticky');
      if ('fixed' === this.header.css('position') || 'absolute' === this.header.css('position')) {
        const headerHeight = this.header.outerHeight();
        this.contents.css('marginTop', `${headerHeight}px`);
      }
    }
  }
}
