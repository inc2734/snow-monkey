'use strict';

import $ from 'jquery';

import '../../assets/packages/slick-carousel';
import '../../assets/packages/jquery.sticky';
import '../../assets/packages/jquery.background-parallax-scroll';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';
import './_wpaw-pickup-slider.js';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header.js';
import FixAdminBar from './_fix-adminbar.js';
import SnowMonkeyWidgetItemExpander from './_widget-item-expander.js';
import SnowMonkeyHeader from './_header.js';
import SnowMonkeyDropNav from './_drop-nav.js';
import SnowMonkeySmoothScroll from './_smooth-scroll.js';
import SnowMonkeyFooterStickyNav from './_footer-sticky-nav.js';
import SnowMonkeyHashNav from './_hash-nav.js';
import SnowMonkeyAnchorPageScroll from './_anchor-page-scroll.js';
import SnowMonkeyActiveMenu from './_active-menu.js';

new BasisStickyHeader();
new FixAdminBar();
new SnowMonkeyHeader();
new SnowMonkeyDropNav();
new SnowMonkeyAnchorPageScroll();
new SnowMonkeySmoothScroll();

new SnowMonkeyFooterStickyNav();

new SnowMonkeyHashNav();

new SnowMonkeyActiveMenu('.p-global-nav', {
  home_url: snow_monkey.home_url,
});

new SnowMonkeyActiveMenu('.p-footer-sticky-nav', {
  home_url: snow_monkey.home_url,
});

new SnowMonkeyWidgetItemExpander();

$('.l-sidebar-sticky-widget-area').sticky({
  breakpoint: 1024,
  offset  : (() => {
    if ('sticky' === $('.l-header').attr('data-l-header-type')) {
      return $('.l-header').outerHeight() + parseInt($('html').css('margin-top'));
    }
    return $('.l-header__drop-nav .p-global-nav').outerHeight() + parseInt($('html').css('margin-top'));
  })()
});

$('.js-bg-parallax').backgroundParallaxScroll();

$('.wpaw-pickup-slider__canvas').SnowMonkeyWpawPickupSlider();
