<template>
	<div class="app">
		<BootAlert ref="bootAlert" :timer="5" variant="warning">
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
		<div id="imagesGrid">
			<BCard
				v-for="image in images"
				:key="image.url"
				:footer="image.title"
				img-alt="Image"
				img-top
				style="max-width: 20rem; min-width: 20rem;"
				tag="article"
			>
				<BCardImg :src="image.url" alt="Image" style="max-height: 15rem;" class="rounded-0"></BCardImg>
				<BButton @click="deleteImage( image )">&times;</BButton>
			</BCard>
		</div>
	</div>
</template>

<script>
import { BFormFile, BButton, BBadge, BAlert, BCard, BCardImg, BCardFooter } from 'bootstrap-vue'
import BootAlert from "../components/BootAlert";

export default {
	name: "App",
	components: { BootAlert, BFormFile, BButton, BBadge, BAlert, BCard, BCardImg, BCardFooter },
	data() {
		return {
			files: [],
			images: [],
			bootAlertMessage: 'Success...'
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
		deleteImage( image ) {
			console.log( image );
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
						self.showAlert( 'Error parsing' );
						return;
					}

					if ( response.success && response.images && response.images.length ) {
						self.setImages( response.images );
						self.showAlert( response.success );
					}
					else {
						self.showAlert( response.error );
					}

				}
				else {
					self.showAlert( request.status );
				}

			};

			request.send( formData );
		},
		setImages( images ) {
			this.images = [ ...this.images, ...images ];
		},
		showAlert( message ) {
			this.bootAlertMessage = message;
			this.$refs.bootAlert.show();
		},
		remote( prop = '' ) {
			return prop ? window.filesConfig[ prop ] : window.filesConfig;
		}
	}
}
</script>

<style scoped>
#imagesGrid {
	display: grid;
	grid: repeat(3, 1fr) / repeat(4, 1fr);
	grid-gap: 1em;
	grid-template: repeat(auto-fit, 21rem) / repeat(auto-fit, 21rem);
	grid-auto-flow: row;
}

#imagesGrid .card {
	position: relative;
}

#imagesGrid .card button {
	position: absolute;
	top: 1rem;
	right: 1rem;
	opacity: 0;
	transition: 0.2s ease-in-out;
}

#imagesGrid .card:hover button{
	opacity: 1;
}
</style>
