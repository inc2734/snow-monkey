'use strict';

import $ from 'jquery';
import '../../../assets/packages/jquery.smoothscroll/src/jquery.smoothscroll.js';

export default class SnowMonkeySmoothScroll {

  constructor() {
    this.pageTop = $('.c-page-top');

    $(window).load(() => {
      this._updatePageTopBtnPosition();
      this._setSmoothScrollEvent();
    });

    $(window).resize(() => {
      this._updatePageTopBtnPosition();
    });

    let timer = null;

    $(window).scroll(() => {
      clearTimeout(timer);

      setTimeout(() => {
        if (500 > $(window).scrollTop()) {
          this.pageTop.attr('aria-hidden', 'true');
        } else {
          this.pageTop.attr('aria-hidden', 'false');
        }
      }, 500);
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

    $('.wpco a[href^="#"], .u-smooth-scroll[href^="#"], .u-smooth-scroll a[href^="#"]').SmoothScroll({
      duration: 1000,
      easing  : 'easeOutQuint',
      offset  : () => {
        return this._getAdminBarHeight();
      }
    });
  }

  _getAdminBarHeight() {
    const scroll         = $(window).scrollTop();
    const headerType     = $('.l-header').attr('data-l-header-type');
    const adminBarHeight = ('fixed' === $('#wpadminbar').css('position')) ? parseInt($('html').css('margin-top')) : 0;

    if ('sticky' === headerType || 'overlay' === headerType) {
      return $('.l-header').outerHeight() + adminBarHeight;
    }

    if ('false' === $('.l-header__drop-nav').attr('aria-hidden')) {
      return $('.l-header__drop-nav .p-global-nav').outerHeight() + adminBarHeight;
    }

    return adminBarHeight;
  }
}
