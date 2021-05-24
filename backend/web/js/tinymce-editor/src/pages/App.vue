<template>
	<div class="app">
		<TinyMCETitle v-model="pageData.title"/>
		<TinyMCEContent v-model="pageData.content"/>
		<AttachmentFieldCard
			:files="remote( 'data/images' )"
			:url-prefix="remote( 'data/publicUrl' )"
			@on-select="setAttachment"
			@on-delete="deleteAttachment"
		/>
		<div class="button-wrapper">
			<button class="btn btn-primary btn-lg" type="button" @click="savePage">Save Page</button>
		</div>
	</div>
</template>

<script>
import { BButton } from 'bootstrap-vue'
import RemoteMixin from "../mixins/RemoteMixin";
import TinyMCEApiMixin from "../mixins/TinyMCEApiMixin";

import "../alert.css";
import AttachmentFieldCard from "../components/AttachmentFieldCard";
import TinyMCETitle from "../components/TinyMCETitle";
import TinyMCEContent from "../components/TinyMCEContent";
import AjaxRequest from "../mixins/AjaxRequest";
import ToastPluginMixin from "../mixins/ToastPluginMixin";


const $ = jQuery;

export default {
	name: 'app',
	mixins: [ RemoteMixin, TinyMCEApiMixin, AjaxRequest, ToastPluginMixin ],
	components: {
		TinyMCEContent,
		TinyMCETitle,
		AttachmentFieldCard,
		BButton,
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
		}
	},
	created() {
		const { model = {} } = this.remote( 'data' );

		this.pageData = { ...this.pageData, ...model };
	},
	methods: {
		deleteAttachment() {
			this.$set( this.pageData, 'attachment_id', 0 );
		},
		setAttachment( selected ) {
			this.$set( this.pageData, 'attachment_id', +selected.id );
		},
		savePage() {
			this.ajax( {
				...this.remote( 'request' ),
				data: this.pageData
			} );
		},
	}
}
</script>

<style scoped>
.app {
	padding: 1rem;
}

.app .button-wrapper {
	text-align: end;
}

</style>

