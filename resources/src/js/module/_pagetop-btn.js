'use strict';

import $ from 'jquery';
import {scrollTop, getFooterStickyNav, setStyle, getStyle} from './_helper.js';

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
        if (500 > scrollTop()) {
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
      setStyle(this.btn, 'bottom', '');
    } else if (parseInt(getStyle(this.btn, 'bottom')) < parseInt(footerStickyNav.offsetHeight)) {
      setStyle(this.btn, 'bottom', `${footerStickyNav.offsetHeight}px`);
    } else {
      setStyle(this.btn, 'bottom', '');
    }
  }

  _resize() {
    if (window.innerWidth === this.defaultWindowWidth) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this._updatePageTopBtnPosition();
  }
}
