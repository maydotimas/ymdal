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
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/neon/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css',
    'public/neon/assets/css/font-icons/entypo/css/entypo.css',
    'public/neon/assets/css/bootstrap.css',
    'public/neon/assets/css/neon-core.css',
    'public/neon/assets/css/neon-theme.css',
    'public/neon/assets/css/neon-forms.css',
    'public/neon/assets/css/custom.css',
    'public/css/vendor/videojs.css'
], 'public/css/neon_auth.css');

mix.styles([
    'public/neon/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css',
    'public/neon/assets/css/bootstrap.css',
    'public/neon/assets/css/neon-core.css',
    'public/neon/assets/css/neon-theme.css',
    'public/neon/assets/css/neon-forms.css',
    'public/neon/assets/css/custom.css',
], 'public/css/neon_app.css');
