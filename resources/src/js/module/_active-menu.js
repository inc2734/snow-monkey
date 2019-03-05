'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

export default class ActiveMenu {
  constructor(nav, params = {}) {
    if (! nav) {
      return;
    }

    const location = window.location;

    params.home_url = params.home_url || `${location.protocol}//${location.host}`;

    const links     = nav.getElementsByTagName('a');
    const vlocation = this._createVlocation(params.home_url);

    forEachHtmlNodes(
      links,
      (atag) => {
        if (typeof atag.hostname === 'undefined') {
          return;
        }

        const atagPathname     = atag.pathname.replace(/\/$/, '');
        const atagHref         = atag.href.replace(/\/$/, '') + '/';
        const locationHref     = location.href.replace(/\/$/, '') + '/';
        const locationPathname = location.pathname.replace(/\/$/, '');
        const vaPathname       = atagPathname.replace(new RegExp(`^${vlocation.pathname}`), '');

        const sameUrl  = locationHref === atagHref;
        const childUrl = 0 === locationHref.indexOf(atagHref)
                      && 1 < locationPathname.length
                      && 1 < atagPathname.length
                      && 1 < vaPathname.length;
        if (sameUrl || childUrl) {
          return this._active(atag);
        }
      }
    );
  }

  _createVlocation(homeUrl) {
    const element = document.createElement('a');
    element.setAttribute('href', homeUrl);
    return element;
  }

  _active(element) {
    element.parentNode.setAttribute('data-active-menu', 'true');
  }
}
