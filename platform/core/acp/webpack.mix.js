const mix = require("laravel-mix");
const path = require("path");

const directory = path.basename(path.resolve(__dirname));
const source = `platform/core/${directory}`;
const dist = `public/vendor/core/core/${directory}`;

mix.js(`${source}/resources/js/role.js`, `${dist}/js`).js(
    `${source}/resources/js/user.js`,
    `${dist}/js`
);

if (mix.inProduction()) {
    mix.copy(`${dist}/js/role.js`, `${source}/public/js`).copy(
        `${dist}/js/user.js`,
        `${source}/public/js`
    );
}
