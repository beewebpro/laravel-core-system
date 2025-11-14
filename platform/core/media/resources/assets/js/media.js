import MediaComponent from "./components/MediaComponent.vue";

if (typeof window.vueApp !== "undefined") {
    window.vueApp.registerPlugins({
        install(app) {
            app.component("media", MediaComponent);
        },
    });
}
