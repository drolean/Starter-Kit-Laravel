const { mix } = require('laravel-mix');

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

mix.autoload({})

// Base Directories
var npm   = 'node_modules/';

// CSS
mix.sass('resources/assets/sass/app.scss', 'public/static/css/app.css').version();

// JS
mix.js('resources/assets/js/app.js', 'public/static/js/app.js').version();

// Vue
mix.js('resources/assets/js/dashboard.js', 'public/static/js').version();
