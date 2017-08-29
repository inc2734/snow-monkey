'use strict';

import '../../../vendor/inc2734/wp-basis/node_modules/sass-basis/src/js/basis.js';

import BasisStickyHeader from '../../../vendor/inc2734/wp-basis/node_modules/sass-basis-layout/src/js/sticky-header.js';
new BasisStickyHeader();

import Inc2734_WP_Share_Buttons from '../../../vendor/inc2734/wp-share-buttons/src/assets/js/wp-share-buttons.js';
new Inc2734_WP_Share_Buttons();

import FixAdminBar from './fix-adminbar.js';
new FixAdminBar();

import SnowMonkeyMainVisual from './main-visual.js';
new SnowMonkeyMainVisual();

import SnowMonkeyWidgetItemExpander from './widget-item-expander.js';
new SnowMonkeyWidgetItemExpander();

import SnowMonkeyDropNav from './drop-nav.js';
new SnowMonkeyDropNav();

jQuery(function($) {
  var init = function() {
    if (1023 < $(window).width()) {
      $('.l-header').attr('data-l-header-type', '');
      $('.l-contents').css('margin-top', '');
    } else {
      $('.l-header').attr('data-l-header-type', 'sticky');
      if ('fixed' === $('.l-header').css('position') || 'absolute' === $('.l-header').css('position')) {
        const headerHeight = $('.l-header').outerHeight();
        $('.l-contents').css('marginTop', `${headerHeight}px`);
      }
    }
  }

  init();

  $(window).resize(function() {
    init();
  });
});
