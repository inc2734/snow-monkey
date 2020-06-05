const api = wp.customize;

api.bind(
  'ready',
  () => {
    api(
      'design-skin',
      (setting) => {
        setting.bind((value) => {
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
      }
    );
  }
);
