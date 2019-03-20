'use strict';

import '../../assets/packages/slick-carousel';
import '../../assets/packages/jquery.background-parallax-scroll';
import '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis/src/js/basis.js';

import $ from 'jquery';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import {initWpawPickupSlider} from './module/_wpaw-pickup-slider.js';

import BasisStickyHeader from '../../vendor/inc2734/wp-basis/src/assets/packages/sass-basis-layout/src/js/sticky-header.js';
import WidgetItemExpander from './module/_widget-item-expander.js';
import SmoothScroll from './module/_smooth-scroll.js';
import PageTopBtn from './module/_pagetop-btn.js';
import HashNav from './module/_hash-nav.js';
import AnchorPageScroll from './module/_anchor-page-scroll.js';

$('.js-bg-parallax').backgroundParallaxScroll();

const canvases = document.querySelectorAll('.wpaw-pickup-slider__canvas');
forEachHtmlNodes(canvases, (canvas) => initWpawPickupSlider(canvas));

document.addEventListener(
  'DOMContentLoaded',
  () => {
    new BasisStickyHeader();

    const submenus = document.querySelectorAll('.c-widget .children, .c-widget .sub-menu');
    forEachHtmlNodes(submenus, (submenu) => new WidgetItemExpander(submenu));

    const drawerControlLinks = document.querySelectorAll('a[href="#sm-drawer"]');
    forEachHtmlNodes(drawerControlLinks, (link) => new HashNav(link));

    new PageTopBtn(document.querySelector('.c-page-top'));
    new AnchorPageScroll();
  },
  false
);

window.addEventListener(
  'load',
  () => {
    const smoothScrollLinks = document.querySelectorAll(
      [
        '.c-page-top a[href^="#"]',
        '.wpco a[href^="#"]',
        '.u-smooth-scroll[href*="#"]',
        '.u-smooth-scroll a[href*="#"]',
      ].join(',')
    );
    forEachHtmlNodes(smoothScrollLinks, (link) => new SmoothScroll(link));
  },
  false
);
