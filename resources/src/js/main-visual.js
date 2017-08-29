'use strict';

import $ from 'jquery';

export default class SnowMonkeyMainVisual {

  constructor() {
    $(() => {
      const slider = $('.p-main-visual');

      slider.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
        slider.find('.slick-slide').removeClass('pan');
        slider.find('.slick-slide').eq(currentSlide).addClass('pan');
      });

      slider.slick({
        "speed": 500,
        "autoplaySpeed": 4000,
        "slidesToShow": 1,
        "fade": true,
        "autoplay": true,
        "dots": false,
        "infinite": true,
        "adaptiveHeight": true,
        "arrows": true,
        "pauseOnFocus": false,
        "pauseOnHover": false
  		});
    });
  }
}
