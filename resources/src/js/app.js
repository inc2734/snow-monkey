'use strict';

import $ from 'jquery';

import '../../assets/packages/slick-carousel';
import '../../assets/packages/jquery.background-parallax-scroll';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';
import './module/_wpaw-pickup-slider.js';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header.js';
import SnowMonkeyWidgetItemExpander from './module/_widget-item-expander.js';
import SnowMonkeySmoothScroll from './module/_smooth-scroll.js';
import SnowMonkeyHashNav from './module/_hash-nav.js';
import SnowMonkeyAnchorPageScroll from './module/_anchor-page-scroll.js';

new BasisStickyHeader();
new SnowMonkeyAnchorPageScroll();
new SnowMonkeySmoothScroll();
new SnowMonkeyHashNav();
new SnowMonkeyWidgetItemExpander();

$('.js-bg-parallax').backgroundParallaxScroll();
$('.wpaw-pickup-slider__canvas').SnowMonkeyWpawPickupSlider();
