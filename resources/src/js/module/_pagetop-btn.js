'use strict';

import $ from 'jquery';
import {scrollTop, getFooterStickyNav, setStyle} from './_helper.js';

export default class PageTopBtn {
  constructor(btn) {
    this.btn = btn;

    this.defaultWindowWidth = window.innerWidth;

    let timer = null;
    window.addEventListener('scroll', () => this._scroll(timer), false);
    window.addEventListener('load', () => this._updatePageTopBtnPosition(), false);
    window.addEventListener('resize', () => this._resize(), false);
  }

  _scroll(timer) {
    clearTimeout(timer);

    timer = setTimeout(
      () => {
        if (! this._visibleBrowserBar()) {
          this.btn.setAttribute('aria-hidden', 'true');
        } else if (500 > scrollTop()) {
          this.btn.setAttribute('aria-hidden', 'true');
        } else {
          this.btn.setAttribute('aria-hidden', 'false');
        }
      },
      500
    );
  }

  _updatePageTopBtnPosition() {
    const footerStickyNav = getFooterStickyNav();
    if (! footerStickyNav) {
      return;
    }

    setStyle(this.btn, 'bottom', `${footerStickyNav.offsetHeight}px`);
  }

  _resize() {
    window.innerWidth !== this.defaultWindowWidth && this._updatePageTopBtnPosition();
  }

  _visibleBrowserBar() {
    return window.innerHeight === document.documentElement.clientHeight;
  }
}
