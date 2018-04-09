(function() {
  var api = wp.customize;

  api.bind('ready', () => {
    wp.customize('design-skin', (setting) => {
      setting.bind(function(value) {
        api.panel.each((panel) => {
				  panel.container.remove();
				  api.panel.remove(panel.id);
        });

        api.section.each((section) => {
          if ('design-skin' === section.id) {
            return true;
          }

          section.container.remove();
          api.section.remove(section.id);
        });
      });
    });
  });
})(jQuery);
