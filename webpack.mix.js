const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css');

mix.js('resources/js/admin.js', 'public/js')
    .sass('resources/css/admin.scss', 'public/css');
