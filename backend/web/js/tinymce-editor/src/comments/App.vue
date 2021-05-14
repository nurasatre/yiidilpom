<template>
	<div class="app">
		<section class="side-left">
<!--			<TinyMCEContent v-model="pageData.content"/>-->
			<div class="button-wrapper">
				<button class="btn btn-primary btn-lg" type="button" @click="savePage">Save Post</button>
			</div>
		</section>
		<section class="side-right">
			<b-table hover :items="items"></b-table>
		</section>
	</div>
</template>

<script>
import RemoteMixin from "../mixins/RemoteMixin";
import TinyMCEApiMixin from "../mixins/TinyMCEApiMixin";

import "../alert.css";
import TinyMCEContent from "../components/TinyMCEContent";
import { BTable } from 'bootstrap-vue';


const $ = jQuery;

export default {
	name: 'app',
	mixins: [ RemoteMixin, TinyMCEApiMixin ],
	components: {
		TinyMCEContent,
		BTable,
	},
	data() {
		return {
			pageData: {
				id: 0,
			},
			items: [
				{ age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
				{ age: 21, first_name: 'Larsen', last_name: 'Shaw' },
				{
					age: 89,
					first_name: 'Geneva',
					last_name: 'Wilson',
					_rowVariant: 'danger'
				},
				{
					age: 40,
					first_name: 'Thor',
					last_name: 'MacDonald',
					_cellVariants: { age: 'info', first_name: 'warning' }
				},
				{ age: 29, first_name: 'Dick', last_name: 'Dunlap' }
			],
		}
	},
	created() {

	},
	methods: {
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
	display: flex;
}
.app section {
	flex: 1 1;
}
.app section:first-child {
	margin-right: 1rem;
}

/*.app .button-wrapper {
	text-align: end;
	margin-top: 1rem;
}*/

.app .mce-content-body {
	outline-offset: 20px;
}

</style>

