import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { widgetItemExpander } from './module/_widget-item-expander';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const targets = [
      '.cat-item .children',
      '.menu-item .sub-menu',
    ];
    const submenus = document.querySelectorAll(targets.join(','));

    forEachHtmlNodes(submenus, widgetItemExpander);
  },
	false
);
