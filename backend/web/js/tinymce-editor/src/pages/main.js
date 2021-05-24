import Vue from 'vue'
import App from './App.vue'
import { ModalPlugin } from "bootstrap-vue";
import { VBModal } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.directive('b-modal', VBModal)
Vue.use( ModalPlugin );

new Vue({
  el: '#pagesEditor',
  render: h => h(App)
})
