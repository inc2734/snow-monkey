'use strict';

export default class SnowMonkeyHashNav {
  constructor() {
    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    this.drawer = document.getElementById('drawer-nav');
    if (! this.drawer) {
      return;
    }

    this.hamburgerBtn = document.getElementById(this.drawer.getAttribute('aria-labelledby'));
    if (! this.hamburgerBtn) {
      return;
    }

    this._forEachHtmlNodes(document.querySelectorAll('a[href="#sm-drawer"]'), (element) => {
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

      this._forEachHtmlNodes(this.drawer.getElementsByClassName('c-drawer__toggle'), (element) => {
        element.setAttribute('aria-expanded', 'false');
      });

      this._forEachHtmlNodes(this.drawer.getElementsByClassName('c-drawer__submenu'), (element) => {
        element.setAttribute('aria-hidden', 'true');
      });
    } else {
      this.drawer.setAttribute('aria-hidden', 'false');
      this.hamburgerBtn.setAttribute('aria-expanded', 'true');
    }
  }

  _forEachHtmlNodes(htmlNodes, callback) {
    if (0 < htmlNodes.length) {
      [].forEach.call(htmlNodes, (htmlNode) => callback(htmlNode));
    }
  }
}
