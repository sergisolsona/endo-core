let mix = require('laravel-mix');

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

mix.setPublicPath('./src/public')
    .js('./src/resources/assets/js/app.js', 'js')
   .sass('./src/resources/assets/sass/app.scss', 'css')
    .options({
        processCssUrls: false
    })
    .version();
