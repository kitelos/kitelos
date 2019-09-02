const mix = require('laravel-mix');

mix.webpackConfig({
   resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
         '@': __dirname + '/resources/js/',
         '#': __dirname + '/resources/js/components',
         '&': __dirname + '/resources/js/admin',
         '%': __dirname + '/resources/js/client',
         '@conf': __dirname + '/resources/js/config'
      },
   },
})

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
   .stylus('resources/stylus/app.styl', 'public/css')
   .sourceMaps(true, 'source-map');