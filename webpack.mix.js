const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css');

mix.autoload({
    'jquery': ['$', 'window.jQuery', 'jquery']
})

mix.scripts([
        'resources/assets/metronic/scripts.bundle.js'
    ], 'metronic/base/scripts.bundle.js')
    .scripts([
        'resources/assets/metronic/vendors.bundle.js'
    ], 'metronic/vendors/vendors.bundle.js');

