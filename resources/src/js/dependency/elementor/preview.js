'use strict';

import $ from 'jquery';
import { initWpawPickupSlider } from '../../module/_wpaw-pickup-slider';

$(window).on(
  'elementor/frontend/init',
  () => {
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/widget',
      (scope) => {
        if (scope.hasClass('elementor-widget-wp-widget-inc2734_wp_awesome_widgets_pickup_slider')) {
          scope.find('.wpaw-pickup-slider__canvas:not(.slick-initialized)').each((i, e) => initWpawPickupSlider(e));
        } else if (scope.hasClass('elementor-widget-wp-widget-inc2734_wp_awesome_widgets_showcase')) {
          scope.find('.wpaw-showcase').backgroundParallaxScroll();
        }
      }
    );
  }
);
