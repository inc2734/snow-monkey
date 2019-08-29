'use strict';

import $ from 'jquery';
import {scrollTop, getFooterStickyNav, setStyle, getStyle} from './_helper.js';

export default class PageTopBtn {
  constructor(btn) {
    this.btn = btn;

    this.defaultWindowWidth = window.innerWidth;

    let timer = null;
    window.addEventListener('scroll', () => this._scroll(timer), false);
  }

  _scroll(timer) {
    clearTimeout(timer);

    timer = setTimeout(
      () => {
        const ariaHidden = 500 > scrollTop() ? 'true' : 'false';
        this.btn.setAttribute('aria-hidden', ariaHidden);
      },
      500
    );
  }
}
