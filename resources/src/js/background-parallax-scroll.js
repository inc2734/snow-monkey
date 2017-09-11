'use strict';

import $ from 'jquery';

$(function() {
  $.fn.SnowMonkeyBackgroundParallaxScroll = function(params) {
    params = $.extend({
      speed: 3
    }, params);

    return this.each(function(i, e) {
      const target = $(e);
      let bpy = 0;

      init();
      setPosition(0);

      $(window).resize(() => {
        init();
        setPosition($(window).scrollTop());
      });

      $(window).scroll(() => {
        setPosition($(window).scrollTop());
      });

      function init() {
        target.css('background-position-y', '')
        bpy = target.css('background-position-y');
      }

      function setPosition(scroll) {
        scroll = parseInt(scroll);
        const offset   = target.offset().top;
        const parallax = ((scroll - offset) / params.speed);
        const newBpy   = `calc(${bpy} - ${parallax}px)`;
        target.css('background-position-y', newBpy);
      }
    });
  }
});
