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
var bower = 'bower_components/';

// Copiando Fontes
mix.copy('bower_components/font-awesome/fonts', 'public/static/fonts/font-awesome/');

// CSS
mix.sass('resources/assets/sass/app.scss', 'public/static/css/app.css').version();

// JS
mix.scripts([
    bower + 'jquery/dist/jquery.min.js',
    bower + 'popper.js/dist/umd/popper.js',
    bower + 'bootstrap/dist/js/bootstrap.min.js',
    bower + 'jquery-ujs/src/rails.js',
    bower + 'jquery-mask-plugin/src/jquery.mask.js',
    bower + 'alertifyjs/src/js/alertify.js',
    bower + 'flatpickr/dist/flatpickr.min.js',
    bower + 'flatpickr/dist/l10n/pt.js',
    'resources/assets/js/snd.js',
    'resources/assets/js/app.js'
], 'public/static/js/app.js').version();

// Vue
mix.js('resources/assets/js/dashboard.js', 'public/static/js').version();