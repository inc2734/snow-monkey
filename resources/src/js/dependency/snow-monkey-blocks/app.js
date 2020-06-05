import $ from 'jquery';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

import {
  scrollTop,
  getScrollOffset,
} from '../../module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const main = (slider) => {
      const dots = slider.querySelectorAll('.slick-dots > li');
      const addClickEvent = (dot) => {
        const handleClick = (event) => {
          const sliderRectTop = slider.getBoundingClientRect().top;
          if (0 > sliderRectTop) {
            const offsetTop = sliderRectTop + scrollTop();
            window.scrollTo(0, offsetTop - getScrollOffset());
          }
        };
        dot.addEventListener('click', handleClick, false);
      };
      forEachHtmlNodes(dots, addClickEvent);
    };

    const thumbnailGalleryBlocks = document.querySelectorAll('.smb-thumbnail-gallery__canvas');
    forEachHtmlNodes(thumbnailGalleryBlocks, main);
  }
);
