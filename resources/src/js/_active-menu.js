'use strict';

import $ from 'jquery';

$.fn.SnowMonkeyActiveMenu = function(params = {}) {
  params = $.extend({ home_url: '' }, params);

  return this.each((i, e) => {
    const nav       = $(e);
    const links     = nav.find('a');
    const location  = window.location;
    const home_url  = !! params.home_url ? params.home_url : `${location.protocol}//${location.host}`;
    const vlocation = $('<a />').attr('href', home_url).get(0);

    links.each((i, e) => {
      const atag = e;
      if (typeof atag.hostname === 'undefined') {
				return true;
      }

      const vaPathname = atag.pathname.replace(new RegExp(`^${vlocation.pathname}`), '/');

      const sameUrl  = location.href === atag.href;
      const childUrl = 0 === location.href.indexOf(atag.href)
                    && 1 < location.pathname.length
                    && 1 < atag.pathname.length
                    && 1 < vaPathname.length;
      if (sameUrl || childUrl) {
        return _active(e);
      }
    });
  });

  function _active(element) {
    $(element).parent('li').attr('data-active-menu', 'true');
  }
};
