import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { hide } from './_helper';

export function widgetItemExpander(submenu) {
  const open = (element) => {
    element.setAttribute('data-is-expanded', 'true');
  };

  const close = (element) => {
    element.setAttribute('data-is-expanded', 'false');
  };

  const show = (element) => {
    element.setAttribute('data-is-hidden', 'false');
  };

  const hide = (element) => {
    element.setAttribute('data-is-hidden', 'true');
  };

  const createBtn = () => {
    const btn   = document.createElement('button');
    const arrow = document.createElement('span');
    arrow.classList.add('c-ic-angle-right');
    hide(arrow);
    btn.insertBefore(arrow, btn.firstElementChild);
    btn.classList.add('children-expander');
    close(btn);
    return btn;
  };

  const parent = submenu.parentNode;
  const btn    = createBtn();

  const handleClick = () => {
    const openMenu = () => {
      open(btn);

      const children  = parent.children;
      const showChild = (element) => 'true' === element.getAttribute('data-is-hidden') && show(element);
      forEachHtmlNodes(children, showChild);
    };

    const closeMenu = () => {
      const expander = parent.querySelectorAll('.children-expander');
      forEachHtmlNodes(expander, close);

      const submenus = parent.querySelectorAll('.children, .sub-menu');
      forEachHtmlNodes(submenus, hide);
    };

    'false' === btn.getAttribute('data-is-expanded') ? openMenu() : closeMenu();
  };

  hide(submenu);

  btn.addEventListener('click', handleClick, false);

  parent.insertBefore(btn, submenu);
}
