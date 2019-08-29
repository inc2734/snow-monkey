'use strict';

import addCustomEvent from '@inc2734/add-custom-event';
import {getBody, getFooterStickyNav, getStyle, setStyle} from './_helper.js';

export default class FooterStickyNav {
  constructor() {
    this.nav = getFooterStickyNav();
    if (! this.nav) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this.navDefaultPaddingBottom = getStyle(this.nav, 'padding-bottom');

    window.addEventListener('load', () => this._init(), false);
    window.addEventListener('resize', () => this._resize(), false);
  }

  static init(nav) {
    const display = getStyle(nav, 'display');
    const hidden  = nav.getAttribute('aria-hidden');
    const body    = getBody();

    const marginBottom = 'true' === nav.getAttribute('aria-hidden') ? '' : `${nav.offsetHeight}px`;
    setStyle(body, 'marginBottom', marginBottom);

    addCustomEvent(nav, 'initFooterStickyNav');
  }

  _init() {
    FooterStickyNav.init(this.nav);
  }

  _resize() {
    this._updateNavHidden();

    if (window.innerWidth === this.defaultWindowWidth) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this._init();
  }

  _updateNavHidden() {
    const ariaHidden = this.navDefaultPaddingBottom !== getStyle(this.nav, 'padding-bottom') ? 'true' : 'false';
    this.nav.setAttribute('aria-hidden', ariaHidden);
  }
}
