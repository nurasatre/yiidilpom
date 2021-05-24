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
			<button class="btn btn-primary btn-lg" type="button" @click="savePage">Save Post</button>
		</div>
	</div>
</template>

<script>
import { BButton } from 'bootstrap-vue'
import BootAlert from "../components/BootAlert";
import BootAlertMixin from "../mixins/BootAlertMixin";
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
	mixins: [ AjaxRequest, ToastPluginMixin, RemoteMixin, TinyMCEApiMixin ],
	components: {
		TinyMCEContent,
		TinyMCETitle,
		AttachmentFieldCard,
		BButton,
		BootAlert
	},
	data() {
		return {
			pageData: {
				id: 0,
				content: 'Start typing here...',
				title: 'New Post',
				attachment_id: 0,
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

.app > div:not(:last-child) {
	margin-bottom: 1.5rem;
}

.app .button-wrapper {
	text-align: end;
}

.app .mce-content-body {
	outline-offset: 20px;
}

</style>

