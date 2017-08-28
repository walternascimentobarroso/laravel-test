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

// mix.js('resources/assets/js/app.js', 'public/js')
  //  .sass('resources/assets/sass/app.scss', 'public/css');

// mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
  //  .copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/fonts/css/font-awesome.min.css')

mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
   .copy('node_modules/bootstrap/dist/fonts', 'public/fonts');

mix.styles([
  'node_modules/font-awesome/css/font-awesome.min.css',
  'node_modules/bootstrap/dist/css/bootstrap.min.css'
], 'public/css/style.css');

mix.scripts([
  'node_modules/jquery/dist/jquery.min.css'
], 'public/js/scripts.js');

mix.sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js')
  .sourceMaps()
  .extract(['jquery', 'bootstrap']);

  mix.browserSync('localhost:8000')
