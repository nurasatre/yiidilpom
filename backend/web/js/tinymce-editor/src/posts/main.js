import Vue from 'vue'
import App from './App.vue'
import { ModalPlugin } from "bootstrap-vue";
import { VBModal } from 'bootstrap-vue'

Vue.directive('b-modal', VBModal)
Vue.use( ModalPlugin );

new Vue({
  el: '#postsEditor',
  render: h => h(App)
})
