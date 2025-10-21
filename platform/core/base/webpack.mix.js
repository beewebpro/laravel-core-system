const mix = require("laravel-mix");
const path = require("path");

const directory = path.basename(path.resolve(__dirname));
const source = `platform/core/${directory}`;
const dist = `public/vendor/core/core/${directory}`;

mix.sass(`${source}/resources/sass/app.scss`, `${dist}/css`)
    .sass(`${source}/resources/sass/bootstrap.scss`, `${dist}/css`)
    .sass(`${source}/resources/sass/icons.scss`, `${dist}/css`)
    .sass(`${source}/resources/sass/custom/crop-image.scss`, `${dist}/css`)
    .js(`${source}/resources/js/app.js`, `${dist}/js`)
    .js(`${source}/resources/js/main.js`, `${dist}/js`)
    .js(`${source}/resources/js/base.js`, `${dist}/js`);

if (mix.inProduction()) {
    mix.copy(`${dist}/css/app.css`, `${source}/public/css`)
        .copy(`${dist}/css/bootstrap.css`, `${source}/public/css`)
        .copy(`${dist}/css/icons.css`, `${source}/public/css`)
        .copy(`${dist}/css/crop-image.css`, `${source}/public/css`)
        .copy(`${dist}/js/app.js`, `${source}/public/js`)
        .copy(`${dist}/js/main.js`, `${source}/public/js`)
        .copy(`${dist}/js/base.js`, `${source}/public/js`);
}
