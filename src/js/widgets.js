import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { widgetItemExpander } from './module/_widget-item-expander';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const submenus = document.querySelectorAll('.c-widget:not(.widget_block) .children, .c-widget:not(.widget_block) .sub-menu');
    forEachHtmlNodes(submenus, widgetItemExpander);
  },
	false
);
