'use strict';

import $ from 'jquery';

import '../../assets/packages/slick-carousel';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';
import '../../assets/packages/jquery.sticky';
import '../../assets/packages/jquery.background-parallax-scroll';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header.js';
new BasisStickyHeader();

import Inc2734_WP_Share_Buttons from '../../vendor/inc2734/wp-share-buttons/src/assets/js/wp-share-buttons.js';
new Inc2734_WP_Share_Buttons();

import FixAdminBar from './fix-adminbar.js';
new FixAdminBar();

import SnowMonkeyMainVisual from './main-visual.js';
new SnowMonkeyMainVisual();

import SnowMonkeyWidgetItemExpander from './widget-item-expander.js';
new SnowMonkeyWidgetItemExpander();

import SnowMonkeyHeader from './header.js';
new SnowMonkeyHeader();

import SnowMonkeyDropNav from './drop-nav.js';
new SnowMonkeyDropNav();

import SnowMonkeyPageTopScroll from './page-top-scroll.js';
new SnowMonkeyPageTopScroll();

import SnowMonkeyFooterStickyNav from './footer-sticky-nav.js';
new SnowMonkeyFooterStickyNav();

$(() => {
  $('.l-sidebar-sticky-widget-area').sticky({
    breakpoint: 1024,
    offset  : (() => {
      if ('sticky' === $('.l-header').attr('data-l-header-type')) {
        return $('.l-header').outerHeight() + parseInt($('html').css('margin-top'));
      }
      return $('.l-header__drop-nav .p-global-nav').outerHeight() + parseInt($('html').css('margin-top'));
    })()
  });
});

$(() => {
  $('.c-page-header').backgroundParallaxScroll();
  $('.wpaw-showcase').backgroundParallaxScroll();
});
