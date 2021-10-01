import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { activeMenu } from './module/_active-menu';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const nav = document.querySelector('.p-global-nav');
    if (! nav) {
      return;
    }

    const links = nav.getElementsByTagName('a');

    const applyActiveMenu = (atag) => {
      const params = {
        home_url: snow_monkey.home_url,
      };
      activeMenu(atag, params);
    };

    forEachHtmlNodes(links, applyActiveMenu);
  }
);
