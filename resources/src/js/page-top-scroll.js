'use strict';

import $ from 'jquery';
import '../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';

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
        easing  : 'easeOutQuint',
        offset  : (() => {
          return parseInt($('html').css('margin-top'));
        })()
      });

      $(window).on('load', () => {
        $('.wpco a[href^="#"]').SmoothScroll({
          duration: 1000,
          easing  : 'easeOutQuint',
          offset  : (() => {
            if ('sticky' === $('.l-header').attr('data-l-header-type')) {
              return $('.l-header').outerHeight() + parseInt($('html').css('margin-top'));
            }
            return $('.l-header__drop-nav .p-global-nav').outerHeight() + parseInt($('html').css('margin-top'));
          })()
        });
      });
    });
  }
}
