<template>
	<div class="appFiles">
		<BButton v-b-modal.modal-attachment>Choose attachment</BButton>
		<BModal
			id="modal-attachment"
			body-class="files-grid hidden-button"
			scrollable
			size="xl"
			title="Choose Attachment"
			@ok="$emit( 'on-select',  selected )"
		>
			<BCard
				v-for="image in images"
				:key="image.id"
				:bg-variant="+image.id === +selected.id ? 'success' : 'light'"
				img-alt="Image"
				style="max-width: 25rem; min-width: 20rem;"
				tag="article"
				:footer="image.title"
				@click="selected = image"
			>
				<BCardImg :src="getImagePlaceholderUrl( image )" alt="Image" class="rounded-0" style="max-height: 15rem;"></BCardImg>
				<BButton
					v-show="+image.id !== +selected.id"
					variant="dark"
					@click="selected = image"
				>
					&#128504;
				</BButton>
			</BCard>
		</BModal>
	</div>
</template>

<script>
import { BButton, BModal, BCard, BCardImg } from 'bootstrap-vue';
import "../modal.css";
import "../button.css";
import "../files-grid.css";
import GetFilePlaceholder from "../mixins/GetFilePlaceholder";

export default {
	name: "FilesModal",
	props: {
		files: {
			type: Array,
			default() {
				return [];
			}
		},
		urlPrefix: String
	},
	mixins: [ GetFilePlaceholder ],
	components: {
		BButton,
		BModal,
		BCard,
		BCardImg,
	},
	data() {
		return {
			selected: {},
			images: []
		};
	},
	created() {
		this.images = this.files.map( image => {
			image.url = this.urlPrefix + image.url;

			return image;
		} );
	},
	methods: {}
}
</script>

<style scoped>

</style>