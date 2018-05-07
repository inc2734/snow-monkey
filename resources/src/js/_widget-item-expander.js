'use strict';

import $ from 'jquery';

export default class SnowMonkeyWidgetItemExpander {

  constructor() {
    const parents = $('.c-widget li:has(.children, .sub-menu)');

    parents.each((i, e) => {
      const parent = $(e);

      parent.prepend('<button class="children-expander" data-is-expanded="false"></button>');
      parent.find('.children, .sub-menu').attr('data-is-hidden', 'true');

      parent.children('.children-expander').click((event) => {
        if ('false' === $(event.target).attr('data-is-expanded')) {
          $(event.target).attr('data-is-expanded', 'true');
          parent.children('.children, .sub-menu').attr('data-is-hidden', 'false');
        } else {
          parent.find('.children-expander').attr('data-is-expanded', 'false');
          parent.find('.children, .sub-menu').attr('data-is-hidden', 'true');
        }
      });
    });
  }
}
