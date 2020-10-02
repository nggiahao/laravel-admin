const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
mix.options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')]
})

mix
    .js('resources/assets/js/app.js', 'public/packages/tessa/js/app.min.js')
    .sass('resources/assets/scss/app.scss', 'public/packages/tessa/css/app.min.css')
    /** Mix themes */
    .sass('resources/assets/scss/color/blue-light.scss', 'public/packages/tessa/css/color/blue-light.min.css')
    .sass('resources/assets/scss/color/blue-dark.scss', 'public/packages/tessa/css/color/blue-dark.min.css')
