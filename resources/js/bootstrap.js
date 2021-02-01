// window._ = require('lodash');
// window.axios = require('axios');
// require('jquery')

import $ from 'jquery';
import aos from 'aos'

global.jQuery = $;
global.$ = $;
global.AOS = aos;

require('script-loader!../template/js/cookies_ui')
require('script-loader!../template/js/script1')

$(document).ready(function ($) {
    const html = $("html");
    if (!catapultReadCookie("catAccCookies")) { // If the cookie has not been set then show the bar
        html.addClass("has-cookie-bar");
        html.addClass("cookie-bar-bottom-left-block");
        html.addClass("cookie-bar-block");
    }
});
