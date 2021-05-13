export default {
	data: function () {
		return {
			bootAlertMessage: 'Success...',
			bootAlertVariant: 'danger'
		}
	},
	methods: {
		errorAlert( message ) {
			this.showAlert( message, 'danger' );
		},
		successAlert( message ) {
			this.showAlert( message, 'success' );
		},
		showAlert( message, type ) {
			this.bootAlertVariant = type;
			this.bootAlertMessage = message;
			this.$refs.bootAlert.show();
		},
	}
}