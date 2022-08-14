const mix = require('laravel-mix');
const config = require('./webpack.config');
const path = require('path');
require('laravel-mix-purgecss');
require('laravel-mix-merge-manifest');

function resolve(dir) {
  return path.join(__dirname, '/resources/js', dir);
}
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
Mix.listen('configReady', webpackConfig => {
  // Add "svg" to image loader test
  const imageLoaderConfig = webpackConfig.module.rules.find(
    rule => String(rule.test) === String(/(\.(png|jpe?g|gif|webp|avif)$|^((?!font).)*\.svg$)/)
  );
  imageLoaderConfig.exclude = resolve('icons');
});

mix
  .js('resources/js/app.js', 'public/js')
  .extract(['vue', 'vuex', 'vue-router', 'vue-i18n', 'axios', 'element-ui', 'nprogress'])
  .webpackConfig(config)
  .mergeManifest()
  .vue({ version: 2 })
  .sass('resources/js/styles/app.scss', 'public/css', {
    implementation: require('node-sass'),
  })
  .purgeCss({
    safelist: {
      standard: [/-active$/, /-enter$/, /-leave-to$/, /show$/, /^el-/],
    },
  })
  .mergeManifest();

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps().webpackConfig({
    devtool: 'eval-cheap-source-map', // Fastest for development
  });
}
