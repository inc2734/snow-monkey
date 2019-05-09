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
        const ariaHidden = 500 > scrollTop() ? 'true' : 'false';
        this.btn.setAttribute('aria-hidden', ariaHidden);
      },
      500
    );
  }

  _updatePageTopBtnPosition() {
    const footerStickyNav = getFooterStickyNav();

    const isOverlapping = parseInt(getStyle(this.btn, 'bottom')) < parseInt(footerStickyNav.offsetHeight);
    let bottom = !! footerStickyNav && isOverlapping ? `${footerStickyNav.offsetHeight}px` : '';
    setStyle(this.btn, 'bottom', bottom);
  }

  _resize() {
    if (window.innerWidth === this.defaultWindowWidth) {
      return;
    }

    this.defaultWindowWidth = window.innerWidth;
    this._updatePageTopBtnPosition();
  }
}
