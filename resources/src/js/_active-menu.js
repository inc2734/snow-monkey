'use strict';

export default class SnowMonkeyActiveMenu {
  constructor(selector, params = {}) {
    this.navs     = document.querySelectorAll(selector);
    this.location = window.location;
    this.params   = params;
    this.params.home_url = !! this.params.home_url ? this.params.home_url : `${this.location.protocol}//${this.location.host}`;

    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this._forEachHtmlNodes(this.navs, (nav) => {
      const links     = nav.getElementsByTagName('a');
      const vlocation = this._createVlocation();

      this._forEachHtmlNodes(links, (atag) => {
        if (typeof atag.hostname === 'undefined') {
          return;
        }

        const atagPathname     = atag.pathname.replace(/\/$/, '');
        const atagHref         = atag.href.replace(/\/$/, '');
        const locationHref     = this.location.href.replace(/\/$/, '');
        const locationPathname = this.location.pathname.replace(/\/$/, '');
        const vaPathname       = atagPathname.replace(new RegExp(`^${vlocation.pathname}`), '');

        const sameUrl  = locationHref === atagHref;
        const childUrl = 0 === locationHref.indexOf(atagHref)
                      && 1 < locationPathname.length
                      && 1 < atagPathname.length
                      && 1 < vaPathname.length;
        if (sameUrl || childUrl) {
          return this._active(atag);
        }
      });
    });
  }

  _createVlocation() {
    const element = document.createElement('a');
    element.setAttribute('href', this.home_url);
    return element;
  }

  _forEachHtmlNodes(htmlNodes, callback) {
    if (0 < htmlNodes.length) {
      [].forEach.call(htmlNodes, (htmlNode) => callback(htmlNode));
    }
  }

  _active(element) {
    element.parentNode.setAttribute('data-active-menu', 'true');
  }
}
