'use strict';

import $ from 'jquery';

export default class SnowMonkeyProfileBox {
  constructor() {
    $(() => {
      $('.wp-profile-box__sns-accounts-item').each((i, e) => {
        $(e).children('a[href*="twitter.com"]').prepend($('<i class="fab fa-twitter" />'));
        $(e).children('a[href*="facebook.com"]').prepend($('<i class="fab fa-facebook" />'));
        $(e).children('a[href*="instagram.com"]').prepend($('<i class="fab fa-instagram" />'));
        $(e).children('a[href*="youtube.com"]').prepend($('<i class="fab fa-youtube" />'));
        $(e).children('a[href*="linkedin.com"]').prepend($('<i class="fab fa-linkedin" />'));
        $(e).children('a[href*="wordpress.org"]').prepend($('<i class="fab fa-wordpress" />'));
        $(e).children('a[href*="wordpress.com"]').prepend($('<i class="fab fa-wordpress" />'));
        $(e).children('a[href*="tumblr.com"]').prepend($('<i class="fab fa-tumblr" />'));
        $(e).children('a:not(:has(i))').prepend($('<i class="fas fa-globe" />'));
      });
    });
  }
}
