<template>
	<div class="app">
		<BootCard header="Title">
			<editor
				v-model="pageData.title"
				:api-key="tinyApi()"
				:init="{
            menubar: false,
            inline: true,
            plugins: [
              'lists',
              'powerpaste',
              'autolink'
            ],
            toolbar: 'undo redo | bold italic underline',
            valid_elements: 'strong,em,span[style],a[href]',
            valid_styles: {
              '*': 'font-size,font-family,color,text-decoration,text-align'
            },
            powerpaste_word_import: 'clean',
            powerpaste_html_import: 'clean',
          }"
				:inline="true"
				tag-name="h1"
			/>
		</BootCard>
		<BootCard header="Content">
			<editor
				v-model="pageData.content"
				:api-key="tinyApi()"
				:init="{
          menubar: false,
          plugins: [
            'autolink',
            'codesample',
            'link',
            'lists',
            'media',
            'powerpaste',
            'table',
            'image',
            'quickbars',
            'codesample',
            'help'
          ],
          toolbar: false,
          quickbars_insert_toolbar: 'quicktable image media codesample',
          quickbars_selection_toolbar: 'bold italic underline | formatselect | blockquote quicklink',
          contextmenu: 'undo redo | inserttable | cell row column deletetable | help',
          powerpaste_word_import: 'clean',
          powerpaste_html_import: 'clean',
        }"
				:inline="true"
			/>
		</BootCard>
		<BootCard header="Attachment">
			<div class="hidden-button attachment-with-button">
				<FilesModal
					:files="remote( 'data' ).images"
					:url-prefix="remote( 'data' ).publicUrl"
					@on-select="setAttachment"
				/>
				<BCard
					v-if="attachment.url && attachment.id"
					img-alt="Image"
					style="max-width: 20rem; min-width: 20rem;"
					tag="article"
				>
					<BCardImg :src="this.attachment.url" alt="Image" class="rounded-0"
							  style="max-height: 15rem;"></BCardImg>
					<BFormInput
						:value="this.attachment.title"
						disabled
						type="text"
					/>
					<BButton variant="danger" @click="deleteAttachment">&times;</BButton>
				</BCard>
			</div>
		</BootCard>
		<div class="button-wrapper">
			<button class="btn btn-primary btn-lg" type="button" @click="savePage">Save Page</button>
		</div>
		<BootAlert ref="bootAlert" :timer="5" :variant="bootAlertVariant">
			{{ bootAlertMessage }}
		</BootAlert>
	</div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';
import BootCard from "../components/BootCard";

import { BFormFile, BButton, BBadge, BAlert, BCard, BCardImg, BCardFooter, BCardText, BFormInput } from 'bootstrap-vue'
import BootAlert from "../components/BootAlert";
import BootAlertMixin from "../mixins/BootAlertMixin";
import RemoteMixin from "../mixins/RemoteMixin";
import TinyMCEApiMixin from "../mixins/TinyMCEApiMixin";

import "../alert.css";
import FilesModal from "../components/FilesModal";


const $ = jQuery;

export default {
	name: 'app',
	mixins: [ BootAlertMixin, RemoteMixin, TinyMCEApiMixin ],
	components: {
		FilesModal,
		Editor,
		BootCard,
		BFormFile,
		BButton,
		BBadge,
		BAlert,
		BCard,
		BCardImg,
		BCardFooter,
		BCardText,
		BFormInput,
		BootAlert
	},
	data() {
		return {
			pageData: {
				id: 0,
				content: 'Start typing here...',
				title: 'My Page',
				attachment_id: 0,
				created_at: new Date().toISOString().slice( 0, 19 ).replace( 'T', ' ' )
			},
			attachment: {}
		}
	},
	created() {
		const { model = {}, images = [], publicUrl } = this.remote( 'data' );

		if ( model.attachment_id ) {
			this.attachment = { ...images.find( item => +item.id === +model.attachment_id ) };
			this.attachment.url = publicUrl + this.attachment.url;
		}

		this.pageData = { ...this.pageData, ...model };
	},
	methods: {
		deleteAttachment() {
			this.attachment = {};
			this.$set( this.pageData, 'attachment_id', 0 );
		},
		setAttachment( selected ) {
			this.attachment = selected;

			this.$set( this.pageData, 'attachment_id', parseInt( selected.id ) );
		},
		savePage() {
			const self = this;

			$.ajax( {
				...this.remote( 'request' ),
				data: this.pageData
			} ).done( function ( response ) {
				if ( response.success ) {
					self.successAlert( response.success )
				}
				else {
					self.errorAlert( response.error )
				}
			} ).fail( function ( response ) {
				self.errorAlert( response.error )
			} )
		},
	}
}
</script>

<style scoped>
.app {
	padding: 1rem;
}

.app > div:not(:last-child) {
	margin-bottom: 1.5rem;
}

.app .button-wrapper {
	text-align: end;
}

.app .mce-content-body {
	outline-offset: 20px;
}

.attachment-with-button {
	display: flex;
	justify-content: space-between;
	align-items: center;
}

</style>

