'use strict';

import $ from 'jquery';

$.fn.SnowMonkeyWpawPrBox = function() {
  return this.each((i, e) => {
    const prbox = $(e);

    prbox.parents().each((i, e) => {
      var parent = $(e);

      if (prbox.css('background-color') !== parent.css('background-color')) {
        return true;
      }

      prbox.addClass('wpaw-pr-box--chameleon');
      return false;
    });
  });
};
