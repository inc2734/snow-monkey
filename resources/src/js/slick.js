'use strict';

import $ from 'jquery';

export default class SnowMonkeySlick {
  constructor() {
    $(() => {
      $('.slick-prev').prepend($('<span />').prepend($('<i class="fas fa-angle-left" />')));
      $('.slick-next').prepend($('<span />').prepend($('<i class="fas fa-angle-right" />')));
    });
  }
}
