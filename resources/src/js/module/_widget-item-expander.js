'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

export default class WidgetItemExpander {
  constructor(submenu) {
    this._hide(submenu);

    const parent = submenu.parentNode;
    const btn    = this._createBtn();

    btn.addEventListener(
      'click',
      () => {
        const open = () => {
          this._open(btn);

          const children = parent.children;
          forEachHtmlNodes(children, (element) => 'true' === element.getAttribute('data-is-hidden') && this._show(element));
        };

        const close = () => {
          const expander = parent.querySelectorAll('.children-expander');
          forEachHtmlNodes(expander, (element) => this._close(element));

          const submenus = parent.querySelectorAll('.children, .sub-menu');
          forEachHtmlNodes(submenus, (element) => this._hide(element));
        };

        'false' === btn.getAttribute('data-is-expanded') ? open() : close();
      },
      false
    );

    parent.insertBefore(btn, parent.firstElementChild);
  }

  _createBtn() {
    const btn = document.createElement('button');
    btn.classList.add('children-expander');
    this._close(btn);
    return btn;
  }

  _open(element) {
    element.setAttribute('data-is-expanded', 'true');
  }

  _close(element) {
    element.setAttribute('data-is-expanded', 'false');
  }

  _show(element) {
    element.setAttribute('data-is-hidden', 'false');
  }

  _hide(element) {
    element.setAttribute('data-is-hidden', 'true');
  }
}
