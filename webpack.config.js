var Encore = require('@symfony/webpack-encore');
var path = require('path');

Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */

    .addEntry('babelpolyfill', '@babel/polyfill')
    .addEntry('entry', './assets/js/entry.js')

    .copyFiles({
        from: './assets/images',
        to: Encore.isProduction() ? 'images/[path][name].[hash:8].[ext]' : 'images/[path][name].[ext]',
    })
    .copyFiles({
        from: './assets/medias',
        to: Encore.isProduction() ? 'medias/[path][name].[hash:8].[ext]' : 'medias/[path][name].[ext]',
    })

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .disableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
// .splitEntryChunks()
;

let config = Encore.getWebpackConfig();

config.resolve.alias = {
    assets: path.resolve(__dirname, './assets'),
    js: path.resolve(__dirname, './assets/js')
};

module.exports = config;
