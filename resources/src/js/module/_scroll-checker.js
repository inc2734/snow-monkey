'use strict';

import {
  getHtml,
  scrollTop,
} from './_helper';

export default class ScrollChecker {
  constructor() {
    this.html = getHtml();

    this._init();
    window.addEventListener('scroll', () => this._init());
    window.addEventListener('resize', () => this._init());
  }

  _init() {
    const scroll   = scrollTop();
    const scrolled = scroll > 0 ? 'true' : 'false';

    this.html.setAttribute('data-scrolled', scrolled);
  }
}
