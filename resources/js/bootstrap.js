// window._ = require('lodash');
// window.axios = require('axios');
require('jquery')
require('../template/js/aos')
require('../template/js/cookies_ui')
require('../template/js/script1')

$(document).ready(function ($) {
    const html = $("html");
    if (!catapultReadCookie("catAccCookies")) { // If the cookie has not been set then show the bar
        html.addClass("has-cookie-bar");
        html.addClass("cookie-bar-bottom-left-block");
        html.addClass("cookie-bar-block");
    }
});
