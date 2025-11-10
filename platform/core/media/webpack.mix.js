const mix = require("laravel-mix");
const path = require("path");

const directory = path.basename(path.resolve(__dirname));
const source = `platform/core/${directory}`;
const dist = `public/vendor/core/core/${directory}`;

mix.js(`${source}/resources/assets/js/media.js`, `${dist}/js`).sass(
    `${source}/resources/assets/sass/media.scss`,
    `${dist}/css`
);

if (mix.inProduction()) {
    mix.copy(`${dist}/js/media.js`, `${source}/public/js`).copy(
        `${dist}/css/media.css`,
        `${source}/public/css`
    );
}
