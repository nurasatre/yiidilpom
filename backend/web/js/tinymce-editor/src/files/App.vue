<template>
	<div class="app">
		<BootAlert ref="bootAlert" :timer="5" :variant="bootAlertVariant">
			{{ bootAlertMessage }}
		</BootAlert>
		<BFormFile
			accept="image/*"
			class="mb-2"
			drop-placeholder="Drop file here..."
			multiple
			name="files"
			placeholder="Choose a file or drop it here..."
			@change="saveFiles"
		>

			<template slot="file-name" slot-scope="{ names }">
				<BBadge variant="dark">{{ names[ 0 ] }}</BBadge>
				<BBadge v-if="names.length > 1" class="ml-1" variant="dark">
					+ {{ names.length - 1 }} More files
				</BBadge>
			</template>
		</BFormFile>
		<div id="imagesGrid" class="hidden-button files-grid">
			<BCard
				v-for="image in images"
				:key="image.id"
				bg-variant="info"
				img-alt="Image"
				style="max-width: 20rem; min-width: 20rem;"
				tag="article"
				text-variant="white"
			>
				<BCardImg :src="image.url" alt="Image" class="rounded-0" style="max-height: 15rem;"></BCardImg>
				<BFormInput
					:value="image.title"
					type="text"
					@change="onInputFileName( $event, image )"
				/>
				<BButton variant="danger" @click="deleteImage( image )">&times;</BButton>
			</BCard>
		</div>
	</div>
</template>

<script>
import {
	BFormFile,
	BButton,
	BBadge,
	BAlert,
	BCard,
	BCardImg,
	BCardFooter,
	BCardText,
	BFormInput
} from 'bootstrap-vue'
import BootAlert from "../components/BootAlert";
import BootAlertMixin from "../mixins/BootAlertMixin";
import RemoteMixin from "../mixins/RemoteMixin";

import "../alert.css";
import "../button.css";
import "../files-grid.css";

export default {
	name: "App",
	mixins: [ BootAlertMixin, RemoteMixin ],
	components: {
		BootAlert,
		BFormFile,
		BButton,
		BBadge,
		BAlert,
		BCard,
		BCardImg,
		BCardFooter,
		BCardText,
		BFormInput,
	},
	data() {
		return {
			files: [],
			images: [],
		};
	},
	created() {
		let { images, publicUrl } = this.remote();

		images.forEach( image => {
			image.url = publicUrl + image.url;
		} )

		this.images = [ ...images ];
	},
	methods: {
		onInputFileName( title, { id } ) {
			const self = this;

			$.ajax( {
				...this.remote( 'update' ),
				data: { id, title }
			} ).done( function ( response ) {
				if ( response.success ) {
					self.successAlert( response.success );
				}
				else {
					self.errorAlert( response.error );
				}
			} ).fail( function ( response ) {
				self.errorAlert( response.error );
			} )
		},
		deleteImage( { id } ) {
			const self = this;

			$.ajax( {
				...this.remote( 'delete' ),
				data: { id }
			} ).done( function ( response ) {
				if ( response.success ) {
					self.successAlert( response.success );

					self.images = self.images.filter( image => +id !== +image.id );
				}
				else {
					self.errorAlert( response.error );
				}
			} ).fail( function ( response ) {
				self.errorAlert( response.error );
			} )
		},
		saveFiles( { target: { files } } ) {
			const self = this;
			const formData = new FormData();

			for ( var i = 0; i < files.length; i++ ) {
				const file = files.item( i );
				formData.append( 'file_' + i, file );
			}
			const args = { ...this.remote( 'save' ) };

			formData.append(
				this.remote( 'csrf' ).param,
				this.remote( 'csrf' ).token
			);

			const request = new XMLHttpRequest();
			request.open( args.method, args.url );

			request.onload = function ( e, r ) {
				if ( request.status === 200 ) {
					let response = e.currentTarget.response;

					try {
						response = JSON.parse( response );
					} catch ( e ) {
						self.errorAlert( 'Error parsing' );
						return;
					}

					if ( response.success ) {
						if ( response.images && response.images.length ) {
							self.setImages( response.images );
						}
						self.successAlert( response.success );
					}
					else {
						self.errorAlert( response.error );
					}

				}
				else {
					self.errorAlert( request.status );
				}

			};

			request.send( formData );
		},
		setImages( images ) {
			this.images = [ ...this.images, ...images ];
		},
	}
}
</script>

<style scoped>
#imagesGrid .card .card-body {
	padding: 0.75rem;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
</style>
