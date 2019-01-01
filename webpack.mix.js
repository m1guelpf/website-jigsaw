let mix = require('laravel-mix');
let build = require('./tasks/build.js');
let glob = require('glob');


mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build/');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch([
            'config.php',
            'source/**/*.md',
            'source/**/*.php',
            'source/**/*.scss',
            'source/**/*.css',
        ]),
    ],
});

glob.sync('source/_assets/js/*.js').forEach(filename => {
    mix.js(filename, 'js');
});

glob.sync('source/_assets/sass/*.scss').forEach(filename => {
    mix.sass(filename, 'css');
});

mix.options({
    processCssUrls: false,
}).version();
