import Vue from 'vue'
import App from './App.vue'
import VueNotification from "vue-notification";

Vue.use(VueNotification);

new Vue({
  el: '#pagesEditor',
  render: h => h(App)
})
