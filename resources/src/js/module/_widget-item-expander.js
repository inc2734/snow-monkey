'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

const open  = (element) => element.setAttribute('data-is-expanded', 'true');
const close = (element) => element.setAttribute('data-is-expanded', 'false');
const show  = (element) => element.setAttribute('data-is-hidden', 'false');
const hide  = (element) => element.setAttribute('data-is-hidden', 'true');

const insertExpander = (submenu) => {
  const parent = submenu.parentNode;

  const toggle = (btn) => {
    const _open = () => {
      open(btn);

      const children = parent.children;
      forEachHtmlNodes(children, (element) => 'true' === element.getAttribute('data-is-hidden') && show(element));
    };

    const _close = () => {
      const expander = parent.querySelectorAll('.children-expander');
      forEachHtmlNodes(expander, (element) => close(element));

      const submenus = parent.querySelectorAll('.children, .sub-menu');
      forEachHtmlNodes(submenus, (element) => hide(element));
    };

    'false' === btn.getAttribute('data-is-expanded') ? _open() : _close();
  };

  const btn = (() => {
    const btn = document.createElement('button');
    btn.classList.add('children-expander');
    close(btn);
    btn.addEventListener('click', () => toggle(btn), false);
    return btn;
  })();

  hide(submenu);
  parent.insertBefore(btn, parent.firstElementChild);
};

export default class SnowMonkeyWidgetItemExpander {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => this._DOMContentLoaded(), false);
  }

  _DOMContentLoaded() {
    const children = document.querySelectorAll('.c-widget .children, .c-widget .sub-menu');
    forEachHtmlNodes(children, (element) => insertExpander(element));
  }
}
