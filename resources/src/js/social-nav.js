'use strict';

import $ from 'jquery';

export default class SnowMonkeySocialNav {
  constructor() {
    $(() => {
      $('.p-social-nav .menu-item').each((i, e) => {
        $(e).children('a[href*="amazon.com"]').prepend($('<i class="fab fa-amazon" />'));
        $(e).children('a[href*="bitbucket.org"]').prepend($('<i class="fab fa-bitbucket" />'));
        $(e).children('a[href*="paypal.com"]').prepend($('<i class="fab fa-paypal" />'));
        $(e).children('a[href*="stripe.com"]').prepend($('<i class="fab fa-stripe" />'));
        $(e).children('a[href*="codepen.io"]').prepend($('<i class="fab fa-codepen" />'));
        $(e).children('a[href*="digg.com"]').prepend($('<i class="fab fa-digg" />'));
        $(e).children('a[href*="dribbble.com"]').prepend($('<i class="fab fa-dribbble" />'));
        $(e).children('a[href*="dropbox.com"]').prepend($('<i class="fab fa-dropbox" />'));
        $(e).children('a[href*="facebook.com"]').prepend($('<i class="fab fa-facebook" />'));
        $(e).children('a[href*="flickr.com"]').prepend($('<i class="fab fa-flickr" />'));
        $(e).children('a[href*="getpocket.com"]').prepend($('<i class="fab fa-get-pocket" />'));
        $(e).children('a[href*="github.com"]').prepend($('<i class="fab fa-github" />'));
        $(e).children('a[href*="gitlab.com"]').prepend($('<i class="fab fa-gitlab" />'));
        $(e).children('a[href*="plus.google.com"]').prepend($('<i class="fab fa-google-plus" />'));
        $(e).children('a[href*="google.com"]').prepend($('<i class="fab fa-google" />'));
        $(e).children('a[href*="instagram.com"]').prepend($('<i class="fab fa-instagram" />'));
        $(e).children('a[href*="linkedin.com"]').prepend($('<i class="fab fa-linkedin" />'));
        $(e).children('a[href*="medium.com"]').prepend($('<i class="fab fa-medium" />'));
        $(e).children('a[href*="pinterest.com"]').prepend($('<i class="fab fa-pinterest" />'));
        $(e).children('a[href*="pinterest.jp"]').prepend($('<i class="fab fa-pinterest" />'));
        $(e).children('a[href*="reddit.com"]').prepend($('<i class="fab fa-reddit" />'));
        $(e).children('a[href*="skype.com"]').prepend($('<i class="fab fa-skype" />'));
        $(e).children('a[href*="slack.com"]').prepend($('<i class="fab fa-slack" />'));
        $(e).children('a[href*="slideshare.net"]').prepend($('<i class="fab fa-slideshare" />'));
        $(e).children('a[href*="snapchat.com"]').prepend($('<i class="fab fa-snapchat" />'));
        $(e).children('a[href*="stackoverflow.com"]').prepend($('<i class="fab fa-stack-overflow" />'));
        $(e).children('a[href*="tumblr.com"]').prepend($('<i class="fab fa-tumblr" />'));
        $(e).children('a[href*="vimeo.com"]').prepend($('<i class="fab fa-vimeo" />'));
        $(e).children('a[href*="twitter.com"]').prepend($('<i class="fab fa-twitter" />'));
        $(e).children('a[href*="weibo.com"]').prepend($('<i class="fab fa-weibo" />'));
        $(e).children('a[href*="wordpress.org"]').prepend($('<i class="fab fa-wordpress" />'));
        $(e).children('a[href*="wordpress.com"]').prepend($('<i class="fab fa-wordpress" />'));
        $(e).children('a[href*="youtube.com"]').prepend($('<i class="fab fa-youtube" />'));
        $(e).children('a:not(:has(i))').prepend($('<i class="fas fa-globe" />'));
      });
    });
  }
}
