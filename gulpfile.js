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

    mix.styles([
        'error.css'
    ], 'public/css/error.css');
});
