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
    this.nav.addEventListener('initFooterStickyNav', () => this._addBodyMargin(), false);
  }

  _init() {
    addCustomEvent(this.nav, 'initFooterStickyNav');
  }

  _resize() {
    this._updateClickable();

    if (window.innerWidth === this.defaultWindowWidth) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this._init();
  }

  _addBodyMargin() {
    const hidden = this.nav.getAttribute('aria-hidden');
    const body   = getBody();

    const marginBottom = 'true' === this.nav.getAttribute('aria-hidden') ? '' : `${this.nav.offsetHeight}px`;
    setStyle(body, 'marginBottom', marginBottom);
  }

  _updateClickable() {
    const clickable = this.navDefaultPaddingBottom !== getStyle(this.nav, 'padding-bottom') ? 'false' : 'true';
    this.nav.setAttribute('data-clickable', clickable);
  }
}
