'use strict';

import {getHeader, getContents, getHtml, getContainer, getAdminBar, scrollTop, getHeaderType, setStyle} from './_helper.js';

export default class FixAdminBar {
  constructor() {
    this.container = getContainer();
    this.header    = getHeader();
    this.contents  = getContents();
    this.html      = getHtml();
    this.adminBar  = getAdminBar();

    if (! this.container || ! this.header || ! this.contents || ! this.adminBar) {
      return;
    }

    this._init()

    window.addEventListener('resize', () => this._init(), false);
    window.addEventListener('scroll', () => this._fixHeaderPosition(), false);
  }

  _init() {
    this._fixHeaderPosition();
    this._fixStickyFooter();
    this._fixDisableWindowScroll();
  }

  _fixHeaderPosition() {
    const headerType = getHeaderType();

    if ( 'sticky' !== headerType && 'overlay' !== headerType) {
      return;
    }

    const scroll = scrollTop();
    const adminbarHeight = this.adminBar.offsetHeight;

    if (window.matchMedia('(min-width: 601px)').matches) {
      this._setHeaderPosition(null);
      this._setHeaderTop(null);
    } else {
      if (scroll >= adminbarHeight) {
        this._setHeaderPosition(null);
        this._setHeaderTop(0);
      } else {
        if ('sticky' === headerType) {
          this._setHeaderPosition('relative');
          this._setHeaderTop(null);
        } else if ('overlay' === headerType) {
          this._setHeaderPosition('absolute');
          this._setHeaderTop(null);
        }

        this.html.setAttribute('data-scrolled', false);
        this._setContentsMarginTop(0);
      }
    }
  }

  _setHeaderPosition(position) {
    setStyle(this.header, 'position', position);
  }

  _setHeaderTop(top) {
    top = null !== top ? `${parseInt(top)}px` : top;
    setStyle(this.header, 'top', top);
  }

  _setContentsMarginTop(marginTop) {
    marginTop = null !== marginTop ? `${parseInt(marginTop)}px` : marginTop;
    setStyle(this.contents, 'marginTop', marginTop);
  }

  _fixStickyFooter() {
    if ('true' == this.html.getAttribute('data-sticky-footer')) {
      const adminbarHeight = this.adminBar.offsetHeight;
      setStyle(this.container, 'minHeight', `calc(100vh - ${adminbarHeight}px)`);
    }
  }

  _fixDisableWindowScroll() {
    if ('false' == this.html.getAttribute('data-window-scroll')) {
      const adminbarHeight = this.adminBar.offsetHeight;
      setStyle(this.container, 'maxHeight', `calc(100vh - ${adminbarHeight}px)`);
    }
  }
}
