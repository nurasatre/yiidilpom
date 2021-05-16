import TinyMCEApiMixin from "./TinyMCEApiMixin";
import Editor from "@tinymce/tinymce-vue";
import BootCard from "../components/BootCard";

import "../pretty-tiny-mce.css";

export default {
	mixins: [ TinyMCEApiMixin ],
	components: { Editor, BootCard },
	props: {
		value: String,
		header: {
			type: String,
			default: 'Content'
		},
		tinyInit: Object
	},
	watch: {
		value() {
			this.$set( this, 'response', this.value );
		},
		response() {
			this.$emit( 'input', this.response )
		}
	},
	data() {
		return {
			response: 'Start typing here...',
		}
	},
	created() {
		this.response = this.value;
		this.editorInit = { ...this.editorInit, ...this.tinyInit };
	}
}