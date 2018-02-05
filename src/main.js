import Vue from 'vue'
import App from './App'
import router from './router'
import BootstrapVue from 'bootstrap-vue'

Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(router)

// Bootstrap

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
