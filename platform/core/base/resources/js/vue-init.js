import mitt from "mitt";
import _ from "lodash";
import sanitizeHtml from "sanitize-html";
import { createApp } from "vue";

export default class VueApp {
    constructor() {
        // Tạo một instance Vue trống
        this.app = createApp({});

        // Tạo event bus (mitt) cho app, gắn vào globalProperties
        this.event = mitt();

        // Các mảng lưu callback cho booting/booted hooks
        this.bootingHooks = [];
        this.bootedHooks = [];

        // Mảng lưu plugin Vue sẽ sử dụng
        this.plugins = [];

        // Trạng thái đã mount chưa
        this.isBooted = false;

        // Globale helpers
        // Nếu không có key, trả về chính key
        this.app.config.globalProperties.__ = (key) =>
            _.get(window.trans, key, key);

        // $sanitize: lọc HTML
        this.app.config.globalProperties.$sanitize = sanitizeHtml;

        // $httpClient: giả lập axios / ajax client toàn cục
        this.app.config.globalProperties.$httpClient = window.$httpClient;

        // $event: gắn event bus toàn cục vào Vue
        this.app.config.globalProperties.$event = this.event;
    }

    // Đăng ký plugin Vue, lưu vào mảng plugins
    use(plugin) {
        this.plugins.push(plugin);
        return this;
    }

    // Thêm callback chạy **trước khi mount**
    booting(callback) {
        this.bootingHooks.push(callback);
        return this;
    }

    // Thêm callback chạy **sau khi mount**
    booted(callback) {
        this.bootedHooks.push(callback);
        return this;
    }

    // Thực hiện mount Vue app
    boot(seletor = "#app") {
        if (this.isBooted) {
            return;
        }

        this.bootingHooks.forEach((callback) => callback(this.app));

        this.plugins.forEach((plugin) => this.app.use(plugin));

        this.app.mount(seletor);

        this.bootedHooks.forEach((callback) => callback(this));

        this.isBooted = true;
    }
}

// Tạo instance vueApp toàn cục
export const vueApp = new VueApp();
window.vueApp = vueApp;

// Tự động boot app khi DOM đã load
document.addEventListener("DOMContentLoaded", () => {
    vueApp.boot();
});
