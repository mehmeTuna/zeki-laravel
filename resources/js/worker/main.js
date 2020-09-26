require("./../bootstrap");

import Vue from "vue";
import App from "./App.vue";
import VModal from "vue-js-modal";

import VueSocketIO from "vue-socket.io";

// server socket link
Vue.use(
    new VueSocketIO({
        connection: "http://localhost:3000"
    })
);
// import VueWorker from "vue-worker";
Vue.use(VModal);
// Vue.use(VueWorker);

new Vue({
    render: h => h(App)
}).$mount("#app");
