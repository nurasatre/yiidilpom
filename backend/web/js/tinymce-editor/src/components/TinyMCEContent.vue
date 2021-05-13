<template>
	<BootCard header="Content">
		<editor
			v-model="response"
			:api-key="tinyApi()"
			:init="editorInit"
			:inline="true"
		/>
	</BootCard>
</template>

<script>
import TinyMCEBaseMixin from "../mixins/TinyMCEBaseMixin";

export default {
	name: "TinyMCEContent",
	mixins: [ TinyMCEBaseMixin ],
	data() {
		return {
			editorInit: {
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
			}
		};
	}
}
</script>

<style scoped>

</style>