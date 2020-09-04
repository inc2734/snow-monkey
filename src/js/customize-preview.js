import $ from 'jquery';

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
      }
    }
  );
});
