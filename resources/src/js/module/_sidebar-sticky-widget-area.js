'use strict';

import '@inc2734/dispatch-custom-resize-event';

import {
  getHeader,
  getAdminbar,
  getDropNavWrapper,
  getStyle,
  setStyle,
} from './_helper';

export default class SidebarStickyWidgetArea {
  constructor() {
    this.header = getHeader();
    this.target = document.querySelector('.l-sidebar-sticky-widget-area');

    if (! this.header || ! this.target) {
      return;
    }

    this._setTopMargin = this._setTopMargin.bind(this);
    this._init();
    window.addEventListener('resize:width', () => this._init(), false);
  }

  _init() {
    this.isSticky       = 'sticky' === getStyle(this.target, 'position');
    this.targetMargin   = parseInt(getStyle(this.target, 'margin-top'));
    this.adminbarHeight = getAdminbar() ? getAdminbar().offsetHeight : 0;
    this.headerPosition = getStyle(this.header, 'position');
    this.headerHeight   = this.header.offsetHeight;
    this.offset         = this._getOffset();

    if (! this.isSticky) {
      window.removeEventListener('scroll', this._setTopMargin, false);
      setStyle(this.target, 'top', '');
    } else {
      window.addEventListener('scroll', this._setTopMargin, false);
      this._setTopMargin();
    }
  }

  _setTopMargin() {
    // Patch for some reason because reflection of header position is delayed
    const headerPosition = getStyle(this.header, 'position');
    'fixed' === headerPosition && headerPosition !== this.headerPosition && this._init();

    const prev = this.target.previousElementSibling;
    const measurement = (() => {
      if (prev) {
        const rect = prev.getBoundingClientRect();
        return rect.y + rect.height;
      }
      return this.target.parentNode.getBoundingClientRect().y;
    })();

    measurement <= this.offset && setStyle(this.target, 'top', `${this.offset}px`);
  }

  _getOffset() {
    if ('fixed' === this.headerPosition) {
      return this.headerHeight + this.adminbarHeight + this.targetMargin;
    }

    const dropNav = getDropNavWrapper();
    const dropNavHeight = dropNav ? dropNav.offsetHeight : 0;
    return dropNavHeight + this.adminbarHeight + this.targetMargin;
  }
}
