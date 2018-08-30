'use strict';

export default class SnowMonkeyHashNav {
  constructor() {
    this.target = document.querySelectorAll('a[href="#sm-drawer"]');
    if (1 > this.target) {
      return;
    }

    this.drawer = document.getElementById('drawer-nav');
    if (! this.drawer) {
      return;
    }

    this.hamburgerBtn = document.getElementById(this.drawer.getAttribute('aria-labelledby'));
    if (! this.hamburgerBtn) {
      return;
    }

    window.addEventListener('DOMContentLoaded', () => this._init(), false);
  }

  _init() {
    [].forEach.call(this.target, (element) => {
      element.addEventListener('click', (event) => {
        event.stopPropagation();
        this._drawer();
        return false
      }, false);
    });
  }

  _drawer() {
    if ('false' === this.drawer.getAttribute('aria-hidden')) {
      this.drawer.setAttribute('aria-hidden', 'true');
      this.hamburgerBtn.setAttribute('aria-expanded', 'false');
    } else {
      this.drawer.setAttribute('aria-hidden', 'false');
      this.hamburgerBtn.setAttribute('aria-expanded', 'true');
    }
  }
}
