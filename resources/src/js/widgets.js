'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import WidgetItemExpander from './module/_widget-item-expander.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const submenus = document.querySelectorAll('.c-widget .children, .c-widget .sub-menu');
    forEachHtmlNodes(submenus, (submenu) => new WidgetItemExpander(submenu));
  }
);
