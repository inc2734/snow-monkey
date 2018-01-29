'use strict';

import $ from 'jquery';

export default class SnowMonkeyWpawPickupSlider {

  constructor() {
    $(() => {
      const slider = $('.wpaw-pickup-slider__canvas');

      slider.slick('slickSetOption', 'arrows', true, true);
      slider.slick('slickSetOption', 'pauseOnFocus', false, true);
      slider.slick('slickSetOption', 'pauseOnHover', false, true);

      slider.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
        slider.find('.slick-slide').removeClass('pan');
        slider.find('.slick-slide').eq(currentSlide).addClass('pan');
      });
    });
  }
}
