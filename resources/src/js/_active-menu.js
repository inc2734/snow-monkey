'use strict';

import $ from 'jquery';

$.fn.SnowMonkeyActiveMenu = function() {
  return this.each((i, e) => {
    const nav      = $(e);
    const links    = nav.find('a');
    const location = window.location;

    links.each((i, e) => {
      const atag = e;
      if (typeof atag.hostname === 'undefined') {
				return true;
      }

      const sameUrl  = location.href === atag.href;
      const childUrl = location.href.indexOf(atag.href) === 0 && 1 < location.pathname.length && 1 < atag.pathname.length;
      if (sameUrl || childUrl) {
        return _active(e);
      }
    });
  });

  function _active(element) {
    $(element).parent('li').attr('data-active-menu', 'true');
  }
};
