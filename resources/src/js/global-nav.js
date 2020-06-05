import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { activeMenu } from './module/_active-menu';
import { hide, show } from './module/_helper';

const apply = (nav) => {
  const links = nav.getElementsByTagName('a');

  const applyActiveMenu = (atag) => {
    const params = {
      home_url: snow_monkey.home_url,
    };
    activeMenu(atag, params);
  };

  forEachHtmlNodes(links, applyActiveMenu);
};

const coordinateDropNav = (gnav) => {
  window.addEventListener('showDropNav', () => hide(gnav));
  window.addEventListener('hideDropNav', () => show(gnav));
};

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const navs = document.querySelectorAll('.p-global-nav');
    if ( 1 > navs.length) {
      return;
    }

    forEachHtmlNodes(navs, apply);

    const gnav = document.querySelector('[data-has-global-nav="true"] .p-global-nav');
    coordinateDropNav(gnav);
  }
);
