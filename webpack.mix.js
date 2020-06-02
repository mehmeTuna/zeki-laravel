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

mix.js('resources/js/dasboard/src/main.js', 'public/dasboard/js')
mix.js('resources/js/frontend/src/main.js', 'public/frontend/js')
mix.js('resources/js/worker/main.js', 'public/worker/js')
