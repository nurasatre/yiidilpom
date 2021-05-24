<template>
	<section class="mt-3">
		<b-form-group
			label="Leave your comment"
			label-for="input-formatter"
		>
			<b-form-textarea
				id="input-formatter"
				v-model="comment.comment_text"
				class="mb-3"
				placeholder="Enter your comment"
			></b-form-textarea>
			<b-button variant="success" @click="saveComment">Save</b-button>
		</b-form-group>
		<b-card
			v-for="item in items"
			:key="item.id"
			:footer="item.created_at"
			:header="item.author"
			class="mb-3"
		>
			{{ item.comment_text }}
		</b-card>
	</section>
</template>

<script>
import { BButton, BCard, BFormGroup, BFormTextarea } from 'bootstrap-vue'
import AjaxRequest from "../mixins/AjaxRequest";
import RemoteMixin from "../mixins/RemoteMixin";
import ToastPluginMixin from "../mixins/ToastPluginMixin";

export default {
	name: "App",
	components: {
		BFormTextarea,
		BFormGroup,
		BButton,
		BCard
	},
	mixins: [ AjaxRequest, RemoteMixin, ToastPluginMixin ],
	data() {
		return {
			comment: {
				comment_text: ''
			},
			post: { ...this.remote( 'post' ) },
			items: [ ...this.remote( 'items' ) ]
		};
	},
	created() {
		this.$set( this.comment, 'post_id', this.post.id );
	},
	methods: {
		saveComment() {
			const options = {
				...this.remote( 'ajaxAdd' ),
				data: this.comment
			};

			this.ajax( options, ( type, response ) => {
				if ( 'success' !== type ) {
					return;
				}
				this.comment.comment_text = '';
				this.items = response.comments;
			} );
		},
	}
}
</script>

<style scoped>

</style>