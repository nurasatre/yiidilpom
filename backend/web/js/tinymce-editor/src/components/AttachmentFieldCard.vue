<template>
	<BootCard :header="header">
		<div class="hidden-button attachment-with-button">
			<FilesModal
				:files="files"
				:url-prefix="urlPrefix"
				@on-select="onSelect"
			/>
			<BCard
				v-if="attachment.url && attachment.id"
				img-alt="Image"
				style="max-width: 20rem; min-width: 20rem;"
				tag="article"
			>
				<BCardImg :src="getImagePlaceholderUrl( attachment )" alt="Image" class="rounded-0"
						  style="max-height: 15rem;"></BCardImg>
				<BFormInput
					:value="this.attachment.title"
					disabled
					type="text"
				/>
				<BButton variant="danger" @click="onDelete">&times;</BButton>
			</BCard>
		</div>
	</BootCard>
</template>

<script>
import FilesModal from "./FilesModal";
import BootCard from "./BootCard";
import BootAlert from "./BootAlert";
import RemoteMixin from "../mixins/RemoteMixin";
import { BAlert, BBadge, BButton, BCard, BCardFooter, BCardImg, BCardText, BFormFile, BFormInput } from 'bootstrap-vue'
import GetFilePlaceholder from "../mixins/GetFilePlaceholder";

export default {
	name: "AttachmentFieldCard",
	components: {
		FilesModal,
		BootCard,
		BootAlert,
		BFormFile,
		BButton,
		BBadge,
		BAlert, BCard, BCardImg, BCardFooter, BCardText, BFormInput
	},
	mixins: [ GetFilePlaceholder ],
	props: {
		header: {
			type: String,
			default: 'Attachment'
		},
		files: {
			type: Array,
			default() {
				return [];
			}
		},
		urlPrefix: String,
		attachmentKey: {
			type: String,
			default: 'attachment_id'
		}
	},
	data() {
		return {
			attachment: {}
		}
	},
	created() {
		const { model = {} } = this.remote( 'data' );

		if ( model[ this.attachmentKey ] ) {
			this.attachment = { ...this.files.find( item => +item.id === +model[ this.attachmentKey ] ) };
			this.attachment.url = this.urlPrefix + this.attachment.url;
		}
	},
	methods: {
		onSelect( selected ) {
			this.attachment = selected;
			this.$emit( 'on-select', selected );
		},
		onDelete() {
			this.attachment = {};
			this.$emit( 'on-delete' );
		}
	}
}
</script>

<style scoped>
.attachment-with-button {
	display: flex;
	justify-content: space-between;
	align-items: center;
}
</style>