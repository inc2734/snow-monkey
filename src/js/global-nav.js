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
