require("./../../bootstrap");

import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import { routes } from './routes'
import store from './store/index'
import './registerServiceWorker'

import Sticky from 'vue-sticky-directive'

Vue.use(Sticky)


Vue.use(VueRouter)




/* eslint-disable no-new */
export const EventBus = new Vue();

Vue.config.productionTip = true;

const router = new VueRouter({
  routes,
  mode:'history'
})

router.afterEach(() =>{
  window.scrollTo(0,0);
});

new Vue({
  render: h => h(App),
  router,
  store
}).$mount('#app')


