import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { widgetItemExpander } from './module/_widget-item-expander';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const submenus = document.querySelectorAll('.c-widget .children, .c-widget .sub-menu');
    forEachHtmlNodes(submenus, widgetItemExpander);
  },
	false
);
