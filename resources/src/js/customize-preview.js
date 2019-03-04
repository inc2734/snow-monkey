'use strict';

import $ from 'jquery';
import {replaceImg} from '../../vendor/inc2734/wp-page-speed-optimization/src/src/js/module/lazyload.js';
import {initWpawPickupSlider} from './module/_wpaw-pickup-slider.js';

$(() => {
  const api = wp.customize;

  api.selectiveRefresh.bind(
    'partial-content-rendered',
    (partial) => {
      if (partial.container) {
        partial.container.find('img').each((i, e) => replaceImg(e));

        // Showcase widget
        if (partial.container.find('.wpaw-showcase').length) {
          partial.container.find('.wpaw-showcase').backgroundParallaxScroll();
        }

        // Pickup slider widget
        if (partial.container.find('.wpaw-pickup-slider__canvas').length) {
          partial.container.find('.wpaw-pickup-slider__canvas').each((i, e) => initWpawPickupSlider(e));
        }
      }
    }
  );
});
