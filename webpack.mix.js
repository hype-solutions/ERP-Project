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

const assets_folder = "resources/assets/";
const assets_output = "public/assets/";

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .js(assets_folder + 'js/users.js', assets_output + 'js')
    .sass('resources/sass/app.scss', 'public/css')

    .js(assets_folder + 'js/vendors.js', assets_output + 'js')
    .js(assets_folder + 'js/app-menu.js', assets_output + 'js')
    .js(assets_folder + 'js/app-min.js', assets_output + 'js')
    .js(assets_folder + 'js/footer.js', assets_output + 'js')
    .js(assets_folder + 'js/custom.js', assets_output + 'js')

    .sass(assets_folder + 'sass/vendors-rtl.scss', assets_output + 'css')
    .sass(assets_folder + 'sass/bootstrap-extended.scss', assets_output + 'css')
    .sass(assets_folder + 'sass/colors.scss', assets_output + 'css')
    .sass(assets_folder + 'sass/components.scss', assets_output + 'css')
    .sass(assets_folder + 'sass/custom-rtl.scss', assets_output + 'css')

    .sass(assets_folder + 'sass/vertical-compact-menu.scss', assets_output + 'css')
    .sass(assets_folder + 'sass/palette-gradient.scss', assets_output + 'css')

    .sass(assets_folder + 'sass/users.scss', assets_output + 'css')

    .copyDirectory(assets_folder + 'images', assets_output + 'images');
