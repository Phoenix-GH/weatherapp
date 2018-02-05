let mix = require('laravel-mix');
var path = require('path');


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

mix.less('resources/assets/less/app.less', 'public/css')
    .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
    .copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css')
    .sass('resources/assets/sass/app.scss', 'public/css/design-app.css')
    .sass('resources/assets/sass/components/dashboard/filter-options.scss', 'public/css/components/dashboard/filter-options.css')
    .sass('resources/assets/sass/components/services/service-providers.scss', 'public/css/components/services/service-providers.css')
    .sass('resources/assets/sass/components/map/map.scss', 'public/css/components/map/map.css')
    .sass('resources/assets/sass/components/dashboard/rail-nav.scss', 'public/css/components/dashboard/rail-nav.css')
    .sass('resources/assets/sass/components/property-list/property-list.scss', 'public/css/components/property-list/property-list.css')
    .sass('resources/assets/sass/components/property-results/property-results.scss', 'public/css/components/property-results/property-results.css')
    .styles('resources/assets/sass/components/newsletter/newsletter.css', 'public/css/components/newsletter/newsletter.css')
    .styles('resources/assets/sass/components/onboarding/onboarding.css', 'public/css/components/onboarding/onboarding.css')
    .styles('resources/assets/sass/global/forms.css', 'public/css/global/forms.css')
    .styles([
        'resources/assets/sass/vendor/css/circle.css'
    ], 'public/css/vendor.min.css')
    .styles([
        'public/css/design-app.css',
        'public/css/components/dashboard/filter-options.css',
        'public/css/components/services/service-providers.css',
        'public/css/components/map/map.css',
        'public/css/components/dashboard/rail-nav.css',
        'public/css/components/property-list/property-list.css',
        'public/css/components/property-results/property-results.css',
        'public/css/components/newsletter/newsletter.css',
        'public/css/components/onboarding/onboarding.css',
        'public/css/global/forms.css'
    ], 'public/css/design-app.min.css')
    .js('resources/assets/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js'),
                'node_modules'
            ],
            alias: {
                'vue$': 'vue/dist/vue.js'
            }
        }
    })
    .version();
