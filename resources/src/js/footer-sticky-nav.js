'use strict';

import $ from 'jquery';

export default class SnowMonkeyFooterStickyNav {
  constructor() {
    $(() => {
      this.nav = $('.p-footer-sticky-nav');

      this._init();

      $(window).on('load resize', () => {
        this._init();
      });
    });
  }

  _init() {
    if ('none' !== this.nav.css('display')) {
      $('body').css('margin-bottom', this.nav.outerHeight());
    } else {
      $('body').css('margin-bottom', '');
    }
  }
}
