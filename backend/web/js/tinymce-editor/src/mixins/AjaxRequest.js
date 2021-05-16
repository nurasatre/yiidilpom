import ToastPluginMixin from "./ToastPluginMixin";

const $ = jQuery;

export default {
	mixins: [ ToastPluginMixin ],
	methods: {
		ajax( requestOptions, onFinishRequest = () => {} ) {
			const self = this;

			$.ajax( requestOptions ).done( function ( response ) {
				if ( response.success ) {
					self.toast( response.success, 'success' )
					onFinishRequest( 'success', response );
				}
				else {
					self.toast( response.error, 'danger' );
					onFinishRequest( 'error', response );
				}
			} ).fail( function ( response ) {
				self.toast( response.error, 'danger' )
				onFinishRequest( 'error', response );
			} )
		}
	}
}