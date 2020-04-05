let mix = require('laravel-mix');
mix.webpackConfig({ node: {
        fs: 'empty',
        net: 'empty',
        tls: 'empty',
        child_process: 'empty',
    }});

const webpack = require('webpack');

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            '$': 'jquery',
            'jQuery': 'jquery',
            'window.jQuery': 'jquery',
        }),
    ]
});
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

mix.scripts([
    'public/theme/assets/js/dashforge.js',
    'public/theme/assets/js/dashforge.filemgr.js',
    'public/theme/assets/js/custom-file-manager-page.js'
], 'public/assets/js/mix/ged.js');


mix.scripts([
    'public/assets/js/scanner.js',
    'public/assets/js/file-manager.js',
    'public/assets/js/scanner-wizard.js'
], 'public/assets/js/mix/documents.js');

mix.scripts([
    'public/theme/lib/jquery/jquery.min.js',
    'public/theme/lib/jqueryui/jquery-ui.min.js',
    'public/theme/lib/bootstrap/js/bootstrap.bundle.min.js',
    'public/theme/lib/feather-icons/feather.min.js',
    'public/theme/lib/perfect-scrollbar/perfect-scrollbar.min.js',
    'public/theme/lib/jquery.flot/jquery.flot.js',
    'public/theme/lib/jquery.flot/jquery.flot.stack.js',
    'theme/lib/jquery.flot/jquery.flot.resize.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/moment.min.js',
    'public/theme/lib/moment/locale/fr.js',
    'public/assets/js/sweetalert.min.js',
    'public/assets/js/delete.handler.js',
    'public/assets/plugins/js-cookie/js.cookie.js',
    'public/vendor/jsvalidation/js/jsvalidation.js',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
    'public/theme/lib/typeahead.js/typeahead.bundle.min.js',
    'public/theme/lib/dropify/dist/js/dropify.min.js',
    'public/theme/lib/flatpicker/flatpickr.js',
    'public/theme/lib/flatpicker/fr.js',
    'public/theme/lib/flatpicker/ar.js',
    'public/theme/lib/select2/js/select2.min.js',
    'public/assets/plugins/croppie/croppie.js',
],'public/assets/js/mix/vendors.js');

mix.styles([
    'public/theme/lib/@fortawesome/fontawesome-free/css/all.min.css',
    'public/theme/lib/ionicons/css/ionicons.min.css',
    'public/theme/lib/jqvmap/jqvmap.min.css',
    'public/assets/css/fontawesome-all.min.css',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css',
    'public/theme/assets/css/dashforge.filemgr.css',
    'public/theme/assets/css/dashforge.css',
    'public/theme/assets/css/dashforge.dashboard.css',
    'public/theme/assets/css/skin.cool.css',
    'public/theme/assets/css/skin.deepblue.css',
    'public/assets/plugins/croppie/croppie.css',
    'public/theme/lib/dropify/dist/css/dropify.min.css',
    'public/theme/lib/flatpicker/flatpickr.min.css',
    'public/theme/lib/select2/css/select2.min.css'
], 'public/assets/css/vendor.css');


mix.sass('resources/sass/app.scss', 'public/assets/css');
mix.version();
if (mix.inProduction()) {
    mix.version();
}



/*
mix.scripts([
    'public/assets/js/popper.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/moment.min.js',
    'public/assets/js/sweetalert.min.js',
    'public/assets/js/delete.handler.js',
    'public/assets/plugins/js-cookie/js.cookie.js',
    'public/vendor/jsvalidation/js/jsvalidation.js',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
    'public/assets/plugins/croppie/croppie.js'
], 'public/assets/js/vendor.js');
*/

/*
mix.styles([
    'public/assets/css/fontawesome-all.min.css',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css',
    'public/assets/plugins/croppie/croppie.css',
], 'public/assets/css/vendor.css');

*/

