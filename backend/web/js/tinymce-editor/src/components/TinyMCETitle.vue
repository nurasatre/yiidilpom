<template>
	<BootCard header="Title" :body-classes="[ 'with-tiny-mce' ]">
		<editor
			v-model="response"
			:api-key="tinyApi()"
			:init="editorInit"
			:inline="true"
			tag-name="h1"
		/>
	</BootCard>
</template>

<script>
import TinyMCEBaseMixin from "../mixins/TinyMCEBaseMixin";

export default {
	name: "TinyMCETitle",
	mixins: [ TinyMCEBaseMixin ],
	data() {
		return {
			editorInit: {
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
			}
		};
	}
}
</script>

<style scoped>

</style>