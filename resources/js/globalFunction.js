export default {
    install(app) {
        app.config.globalProperties.$goBack = (fallbackRoute = "/") => {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = fallbackRoute;
            }
        };
    },
};
