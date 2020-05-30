require("./../../bootstrap");

import Vue from "vue";
import App from "./App.vue";
import { routes } from "./routes";
import VueRouter from "vue-router";
import store from "./store/index";
import { ClientTable } from "vue-tables-2";
import "./registerServiceWorker";
import ToggleButton from "vue-js-toggle-button";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import locale from "element-ui/lib/locale/lang/tr-TR";
Vue.use(ElementUI, { locale });
Vue.use(ToggleButton);
Vue.use(VueRouter);
Vue.use(ClientTable);

Vue.config.productionTip = false;

const router = new VueRouter({
    routes,
    mode: "history",
});
new Vue({
    render: (h) => h(App),
    router,
    store,
}).$mount("#app");
