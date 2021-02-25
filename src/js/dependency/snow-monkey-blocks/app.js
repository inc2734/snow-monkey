import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

import {
  getScrollOffset,
} from '../../module/_helper';

window.addEventListener(
  'load',
  () => {
    const main = (slider) => {
      const dots = slider.querySelectorAll('.slick-dots > li, .spider__dots[data-thumbnails="true"] > .spider__dot');
      const addClickEvent = (dot) => {
        const handleClick = (event) => {
          const sliderRectTop = slider.getBoundingClientRect().top;
          if (0 > sliderRectTop) {
            const offsetTop = sliderRectTop + window.pageYOffset;
            window.scrollTo(0, offsetTop - getScrollOffset());
          }
        };
        dot.addEventListener('click', handleClick, false);
      };
      forEachHtmlNodes(dots, addClickEvent);
    };

    const thumbnailGalleryBlocks = document.querySelectorAll('.smb-thumbnail-gallery__canvas');
    forEachHtmlNodes(thumbnailGalleryBlocks, main);

    const spiderSliderBlocks = document.querySelectorAll('.smb-spider-slider');
    forEachHtmlNodes(spiderSliderBlocks, main);
  }
);
