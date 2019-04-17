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

mix.js('resources/js/app.js', 'htdocs/js')
   .sass('resources/sass/app.scss', 'htdocs/css');

mix.js('resources/assets/js/app.js', 'htdocs/js')
   .sass('resources/assets/sass/app.scss', 'htdocs/css')
   .copy('node_modules/semantic-ui-css/semantic.min.css','htdocs/css/semantic.min.css')
   .copy('node_modules/semantic-ui-css/semantic.min.js','htdocs/js/semantic.min.js');
