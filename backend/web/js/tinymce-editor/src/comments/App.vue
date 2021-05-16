<template>
	<div class="app"
		 @keyup.delete="deleteComment"
		 @keyup.up="moveUp()"
		 @keyup.down="moveDown()"
	>
		<section v-if="currentComment.id" class="side-left">
			<TinyMCEContent v-model="currentComment.comment_text"/>
			<div class="button-wrapper">
				<button class="btn btn-success btn-sm" type="button" @click="saveComment">Save Comment</button>
				<button class="btn btn-danger btn-sm" type="button" @click="deleteComment">Delete Comment</button>
			</div>
		</section>
		<section class="side-right">
			<b-table :fields="fields" :items="items" bordered hover @row-clicked="onClickRow"/>
		</section>
	</div>
</template>

<script>
import RemoteMixin from "../mixins/RemoteMixin";
import TinyMCEApiMixin from "../mixins/TinyMCEApiMixin";

import "../alert.css";
import TinyMCEContent from "../components/TinyMCEContent";
import { BTable } from 'bootstrap-vue';
import AjaxRequest from "../mixins/AjaxRequest";

export default {
	name: 'app',
	mixins: [ RemoteMixin, TinyMCEApiMixin, AjaxRequest ],
	components: {
		TinyMCEContent,
		BTable,
	},
	data() {
		return {
			currentComment: {},
			items: [ ...this.remote( 'posts' ) ],
			fields: [
				{ key: '_excerpt', label: 'Comment Excerpt' },
				'author',
				{ key: 'post_id', label: 'Post Title' },
				{ key: 'parent_id', label: 'Parent Excerpt' },
				'created_at'
			],
		}
	},
	mounted() {
		this.clearCurrentComment();
	},
	methods: {
		moveUp() {
			const comments = JSON.parse( JSON.stringify( this.items ) ).reverse();

			const item = comments.find( item => +item.id < +this.currentComment.id ) || {};
			if ( item ) {
				this.onClickRow( item );
			}
		},
		moveDown() {
			const item = this.items.find( item => +item.id > +this.currentComment.id );
			if ( item ) {
				this.onClickRow( item );
			}
		},
		clearCurrentComment() {
			this.currentComment = {
				id: 0,
				comment_text: 'Click on comment',
				author: 0,
				post_id: 0,
				parent_id: 0,
				created_at: ''
			};
		},
		onClickRow( item ) {
			for ( const itemIndex in this.items ) {
				const { id } = this.items[ itemIndex ];

				if ( id === item.id ) {
					this.$set( this.items, itemIndex, {
						...this.items[ itemIndex ],
						_rowVariant: 'info'
					} )
				}
				else {
					this.$set( this.items, itemIndex, {
						...this.items[ itemIndex ],
						_rowVariant: ''
					} )
				}
			}
			this.currentComment = { ...item };

		},
		saveComment() {
			const self = this;
			const options = {
				...this.remote( 'edit' ),
				data: this.currentComment
			};

			this.ajax( options, ( type, response ) => {
				if ( 'success' !== type ) {
					return;
				}
				self.changeComment( self.currentComment.id, response.model );
			} );
		},
		deleteComment() {
			const self = this;
			const options = {
				...this.remote( 'delete' ),
				data: this.currentComment
			};

			this.ajax( options, ( type, response ) => {
				if ( 'success' !== type ) {
					return;
				}
				self.items.splice( +response.id, 1 );
				self.clearCurrentComment();
			} );
		},

		changeComment( id, value ) {
			this.items.forEach( ( item, index ) => {
				if ( +item.id === +id ) {
					this.$set( this.items, index, value )
				}
			} )
		}
	}
}
</script>

<style scoped>
.app {
	padding: 1rem;
	display: flex;
	position: relative;
}

.app section.side-left {
	margin-right: 1rem;
	max-width: 30vw;
	position: fixed;
}

.app section.side-right {
	max-width: 40vw;
	position: absolute;
	right: 0;
}

</style>

