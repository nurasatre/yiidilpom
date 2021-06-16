import RemoteMixin from "./RemoteMixin";

export default {
	mixins: [ RemoteMixin ],
	methods: {
		getImagePlaceholderUrl( image ) {
			if ( ! image.mime_type || /^image\/(gif|png|jpeg)/.test( image.mime_type ) ) {
				return image.url;
			}
			const absoluteUrl = this.remote( 'publicUrl' ) || this.remote( 'data/publicUrl' );
			const staticLogoUrl = `${ absoluteUrl }logos`;

			if ( /^application\/pdf$/.test( image.mime_type ) ) {
				return `${ staticLogoUrl }/image-pdf.png`;
			}

			if ( /^application\/.*(msword|officedocument)/.test( image.mime_type ) ) {
				return `${ staticLogoUrl }/ms-word.png`;
			}
		}
	}
}