import mitt from "mitt";
import _ from "lodash";
import sanitizeHtml from "sanitize-html";
import { createApp } from "vue";

export default class VueApp {
    constructor() {
        // Tạo app Vue rỗng
        this.app = createApp({
            mounted() {
                // Giống bản cũ: cho phép ép Vue re-render
                this.$event.on("vue-init:force-update", () => {
                    this.$forceUpdate();
                });
            },
        });

        // Event bus (mitt)
        this.event = mitt();

        // Gắn vào globalProperties
        this.app.config.globalProperties.$event = this.event;

        // Helpers global
        this.app.config.globalProperties.__ = (key) => {
            if (typeof window.trans === "undefined") {
                return key;
            }
            return _.get(window.trans, key, key);
        };

        this.app.config.globalProperties.$sanitize = sanitizeHtml;
        this.app.config.globalProperties.$httpClient = window.$httpClient;

        // Plugin & hook system
        this.plugins = [];
        this.bootingHooks = [];
        this.bootedHooks = [];
        this.isBooted = false;
    }

    // Giống registerVuePlugins() bản cũ
    registerPlugins(plugin) {
        this.plugins.push(plugin);
    }

    // Booting & booted callbacks
    booting(callback) {
        this.bootingHooks.push(callback);
    }

    booted(callback) {
        this.bootedHooks.push(callback);
    }

    // Boot Vue
    boot(selector = "#app") {
        if (this.isBooted) return;

        // Chạy hook trước khi mount
        this.bootingHooks.forEach((cb) => cb(this.app));

        // Dùng các plugin đã đăng ký
        this.plugins.forEach((plugin) => this.app.use(plugin));

        // Mount
        this.app.mount(selector);

        // Chạy hook sau mount
        this.bootedHooks.forEach((cb) => cb(this));

        this.isBooted = true;
    }
}

// Instance global
export const vueApp = new VueApp();
window.vueApp = vueApp;

// Boot khi DOM sẵn sàng
document.addEventListener("DOMContentLoaded", () => {
    if (!window.vueApp.isBooted) {
        window.vueApp.boot();
    }
});
