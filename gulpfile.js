const elixir = require('laravel-elixir');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
elixir(function(mix) {
    mix.styles([
        'timeline.css'
    ], 'public/css/timeline.css');

    mix.scripts([
        'edit.js'
    ], 'public/js/edit.js');

    mix.scripts([
        'adtjes.js'
    ], 'public/js/adtjes.js');

    mix.scripts([
        'bug.js'
    ], 'public/js/bug.js');

    mix.copy('resources/assets/img/favicon.ico', 'public/img/favicon.ico');
    mix.copy('resources/assets/img/background.jpg', 'public/img/bg.jpg');
});
