import $ from 'jquery';
import { initWpawPickupSlider } from './module/_wpaw-pickup-slider';

$(() => {
  const api = wp.customize;

  api.selectiveRefresh.bind(
    'partial-content-rendered',
    (partial) => {
      if (partial.container) {
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
