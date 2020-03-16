'use strict';

import $ from 'jquery';
import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

import {
  scrollTop,
  getScrollOffset,
} from '../../module/_helper';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const thumbnailGalleryBlocks = document.querySelectorAll('.smb-thumbnail-gallery__canvas');
    forEachHtmlNodes(
      thumbnailGalleryBlocks,
      (slider) => {
				$(slider).on( 'beforeChange', (event, slick, currentSlideIndex, nextSlideIndex) => {
          const nextSlideId = slick.$slides[ nextSlideIndex ].getAttribute('id');
          const nextSlide = document.getElementById(nextSlideId);

          if ( nextSlide ) {
            const nextSlideRectTop = nextSlide.getBoundingClientRect().top;
            if (0 > nextSlideRectTop) {
              const offsetTop = nextSlideRectTop + scrollTop();
              window.scrollTo(0, offsetTop - getScrollOffset());
            }
          }
				} );
      },
    );
  }
);
