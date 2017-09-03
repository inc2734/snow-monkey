'use strict';

import $ from 'jquery';
import 'jquery.smoothscroll';

export default class SnowMonkeyPageTopScroll {

  constructor() {
    $(() => {
      this.pageTop = $('.c-page-top');

      $(window).scroll(() => {
        if (500 > $(window).scrollTop()) {
          this.pageTop.attr('aria-hidden', 'true');
        } else {
          this.pageTop.attr('aria-hidden', 'false');
        }
      });

      this.pageTop.find('a[href^="#"]').SmoothScroll({
        duration: 1000,
        easing  : 'easeOutQuint'
      });
    });
  }
}
