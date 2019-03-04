'use strict';

import $ from 'jquery';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

import '../../assets/packages/slick-carousel';
import '../../assets/packages/jquery.background-parallax-scroll';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';
import {initWpawPickupSlider} from './module/_wpaw-pickup-slider.js';

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

const canvases = document.querySelectorAll('.wpaw-pickup-slider__canvas');
forEachHtmlNodes(canvases, (canvas) => initWpawPickupSlider(canvas));
