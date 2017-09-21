'use strict';

import $ from 'jquery';

import 'slick-carousel';
import '../../vendor/inc2734/wp-basis/node_modules/sass-basis/src/js/basis.js';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/node_modules/sass-basis-layout/src/js/sticky-header.js';
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

import './background-parallax-scroll.js';
$(function() {
  $('.c-page-header').SnowMonkeyBackgroundParallaxScroll();
  $('.wpaw-showcase').SnowMonkeyBackgroundParallaxScroll();
});
