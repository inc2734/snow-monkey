'use strict';

import $ from 'jquery';

export default class SnowMonkeyWpawPickupSlider {

  constructor() {
    const slider = $('.wpaw-pickup-slider__canvas');

    slider.on('init', function(event, slick) {
      setTimeout(() => {
        slider.slick('slickSetOption', 'arrows', true, true);
        slider.slick('slickSetOption', 'pauseOnFocus', false, true);
        slider.slick('slickSetOption', 'pauseOnHover', false, true);
        slider.slick('slickSetOption', 'prevArrow',
          '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><span><i class="fas fa-angle-left"></i></span></button>',
          true
        );
        slider.slick('slickSetOption', 'nextArrow',
          '<button class="slick-next slick-arrow" aria-label="Next" type="button"><span><i class="fas fa-angle-right"></i></span></button>',
          true
        );

        slider.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
          slider.find('.slick-slide').removeClass('pan');
          slider.find('.slick-slide').eq(currentSlide).addClass('pan');
        });
      }, 0);
    });
  }
}
