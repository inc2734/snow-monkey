'use strict';

export default class SnowMonkeyWidgetItemExpander {

  constructor() {
    window.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    const children = document.querySelectorAll('.c-widget .children, .c-widget .sub-menu');

    this._forEachHtmlNodes(children, (element) => {
      element.setAttribute('data-is-hidden', 'true');

      const parent = element.parentNode;
      const btn = document.createElement('button');
      btn.classList.add('children-expander');
      btn.setAttribute('data-is-expanded', 'false');

      parent.insertBefore(btn, parent.firstElementChild);

      btn.addEventListener('click', (event) => this._click(event), false);
    });
  }

  _click(event) {
    const btn = event.currentTarget;
    const parent = btn.parentNode;

    if ('false' === btn.getAttribute('data-is-expanded')) {
      btn.setAttribute('data-is-expanded', 'true');

      this._forEachHtmlNodes(parent.children, (element) => {
        if ('true' === element.getAttribute('data-is-hidden')) {
          element.setAttribute('data-is-hidden', 'false');
        }
      });
    } else {
      this._forEachHtmlNodes(parent.getElementsByClassName('children-expander'), (element) => {
        element.setAttribute('data-is-expanded', 'false');
      });

      this._forEachHtmlNodes(parent.querySelectorAll('.children, .sub-menu'), (element) => {
        element.setAttribute('data-is-hidden', 'true');
      });
    }
  }

  _forEachHtmlNodes(htmlNodes, callback) {
    if (0 < htmlNodes.length) {
      [].forEach.call(htmlNodes, (htmlNode) => callback(htmlNode));
    }
  }
}
