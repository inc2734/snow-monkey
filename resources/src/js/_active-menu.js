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

      const atagPathname     = atag.pathname.replace(/\/$/, '');
      const atagHref         = atag.href.replace(/\/$/, '');
      const locationHref     = location.href.replace(/\/$/, '');
      const locationPathname = location.pathname.replace(/\/$/, '');
      const vaPathname       = atagPathname.replace(new RegExp(`^${vlocation.pathname}`), '');

      const sameUrl  = locationHref === atagHref;
      const childUrl = 0 === locationHref.indexOf(atagHref)
                    && 1 < locationPathname.length
                    && 1 < atagPathname.length
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
