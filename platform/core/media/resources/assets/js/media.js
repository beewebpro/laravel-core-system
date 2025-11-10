import MediaComponent from "./components/MediaComponent.vue";

if (window.vueApp) {
    window.vueApp.use({
        install(app) {
            app.component("media", MediaComponent);
        },
    });
}
