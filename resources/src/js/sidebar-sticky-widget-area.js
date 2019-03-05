'use strict';

import '../../assets/packages/jquery.sticky';
import $ from 'jquery';

$('.l-sidebar-sticky-widget-area').sticky({
  breakpoint: 1024,
  offset  : (() => {
    const headerType = $('.l-header').attr('data-l-header-type');
    const adminBarHeight = parseInt($('html').css('margin-top'));

    if ('sticky' === headerType || 'overlay' === headerType) {
      return $('.l-header').outerHeight() + adminBarHeight;
    }

    return $('.l-header__drop-nav .p-global-nav').outerHeight() + adminBarHeight;
  })()
});
