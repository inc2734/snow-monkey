'use strict';

import $ from 'jquery';

export default class SnowMonkeyHashNav {
  constructor() {
    $(() => {
      this._drawer();
    });
  }

  /**
   * Opening and closing the drawer
   * #sm-drawer
   */
  _drawer() {
    $('a[href="#sm-drawer"]').on('click', () => {
      const drawer = $('#drawer-nav');
      const hamburgerBtn = $(`#${drawer.attr('aria-labelledby')}`);

      if ('false' === drawer.attr('aria-hidden')) {
        drawer.attr('aria-hidden', 'true');
        hamburgerBtn.attr('aria-expanded', 'false');
      } else {
        drawer.attr('aria-hidden', 'false');
        hamburgerBtn.attr('aria-expanded', 'true');
      }

      return false;
    });
  }
}
