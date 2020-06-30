import $ from 'jquery';

$(window).on(
  'elementor/frontend/init',
  () => {
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/widget',
      (scope) => {
        if (scope.hasClass('elementor-widget-wp-widget-inc2734_wp_awesome_widgets_showcase')) {
          scope.find('.wpaw-showcase').backgroundParallaxScroll();
        }
      }
    );
  }
);
