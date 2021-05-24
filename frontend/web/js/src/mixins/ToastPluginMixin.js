import { ToastPlugin } from 'bootstrap-vue';
import Vue from "vue";
Vue.use( ToastPlugin );


export default {
	methods: {
		toast( message, variant, appendToast = false ) {
			this.$bvToast.toast( message, {
				title: 'Response',
				autoHideDelay: 2000,
				toaster: 'b-toaster-top-right',
				appendToast,
				variant
			} )
		}
	}
}