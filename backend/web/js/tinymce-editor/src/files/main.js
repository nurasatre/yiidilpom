// Import Bootstrap an BootstrapVue CSS files (order is important)
/*import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'*/

import Vue from 'vue'
import App from './App.vue'

new Vue({
  el: '#filesEditor',
  render: h => h(App)
})
