'use strict';

export default class FixAdminBar {
  constructor() {
    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.container = document.getElementsByClassName('l-container');
    this.header    = document.getElementsByClassName('l-header');
    this.contents  = document.getElementsByClassName('l-contents');
    this.html      = document.getElementsByTagName('html').item(0)

    if (1 > this.container.length || 1 > this.header.length || 1 > this.contents.length) {
      return;
    }

    this.container = this.container[0];
    this.header    = this.header[0];
    this.contents  = this.contents[0];
    this.adminBar  = document.getElementById('wpadminbar');

    if (!! this.adminBar) {
      this._init()

      window.addEventListener('resize', () => this._init(), false);
      window.addEventListener('scroll', () => this._fixHeaderPosition(), false);
    }
  }

  _init() {
    this._fixHeaderPosition();
    this._fixStickyFooter();
    this._fixDisableWindowScroll();
  }

  _scroll() {
    this._fixHeaderPosition();
  }

  _fixHeaderPosition() {
    const headerType = this.header.getAttribute('data-l-header-type');

    if ( 'sticky' !== headerType && 'overlay' !== headerType) {
      return;
    }

    const scroll = this._scrollTop();
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
    this.header.style.position = position;
  }

  _setHeaderTop(top) {
    top = null !== top ? `${parseInt(top)}px` : top;
    this.header.style.top = top;
  }

  _setContentsMarginTop(marginTop) {
    marginTop = null !== marginTop ? `${parseInt(marginTop)}px` : marginTop;
    this.contents.style.marginTop = marginTop;
  }

  _fixStickyFooter() {
    if ('true' == this.html.getAttribute('data-sticky-footer')) {
      const adminbarHeight = this.adminBar.offsetHeight;
      this.container.style.minHeight = `calc(100vh - ${adminbarHeight}px)`;
    }
  }

  _fixDisableWindowScroll() {
    if ('false' == this.html.getAttribute('data-window-scroll')) {
      const adminbarHeight = this.adminBar.offsetHeight;
      this.container.style.maxHeight = `calc(100vh - ${adminbarHeight}px)`;
    }
  }

  _scrollTop() {
    return document.documentElement.scrollTop || document.body.scrollTop;
  }
}
