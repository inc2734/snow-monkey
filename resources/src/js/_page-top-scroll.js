'use strict';

import $ from 'jquery';
import '../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';

export default class SnowMonkeyPageTopScroll {

  constructor() {
    this.pageTop = $('.c-page-top');

    $(window).load(() => {
      this._updatePageTopBtnPosition();
      this._setSmoothScrollEvent();
    });

    $(window).resize(() => {
      this._updatePageTopBtnPosition();
    });

    $(window).scroll(() => {
      if (500 > $(window).scrollTop()) {
        this.pageTop.attr('aria-hidden', 'true');
      } else {
        this.pageTop.attr('aria-hidden', 'false');
      }
    });
  }

  _updatePageTopBtnPosition() {
    if ($('.p-footer-sticky-nav').length) {
      this.pageTop.css('bottom', $('.p-footer-sticky-nav')[0].offsetHeight);
    }
  }

  _setSmoothScrollEvent() {
    this.pageTop.find('a[href^="#"]').SmoothScroll({
      duration: 1000,
      easing  : 'easeOutQuint',
      offset  : (() => {
        return parseInt($('html').css('margin-top'));
      })()
    });

    $('.wpco a[href^="#"]').SmoothScroll({
      duration: 1000,
      easing  : 'easeOutQuint',
      offset  : () => {
        const scroll            = $(window).scrollTop();
        const adminBarHeight    = parseInt($('html').css('margin-top'));
        const headerType        = $('.l-header').attr('data-l-header-type');
        const getAdminBarHeight = () => {
          if ('fixed' === $('#wpadminbar').css('position')) {
            return parseInt($('html').css('margin-top'));
          }
          return 0;
        }

        if ('sticky' === headerType || 'overlay' === headerType) {
          return $('.l-header').outerHeight() + getAdminBarHeight();
        }

        if ('false' === $('.l-header__drop-nav').attr('aria-hidden')) {
          return $('.l-header__drop-nav .p-global-nav').outerHeight() + getAdminBarHeight();
        }
        return getAdminBarHeight();
      }
    });
  }
}
