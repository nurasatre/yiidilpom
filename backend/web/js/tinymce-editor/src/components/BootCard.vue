<template>
	<div class="card mb-xl-3">
		<div class="card-header">
			{{ header }}
		</div>
		<div :class="bodyClass">
			<slot></slot>
		</div>
	</div>
</template>

<script>
export default {
	name: "BootCard",
	props: {
		header: String,
		bodyClasses: {
			type: Array,
			default() {
				return [];
			}
		}
	},
	computed: {
		bodyClass() {
			return [ 'card-body', ...this.bodyClasses ].join( ' ' );
		}
	}
}
</script>
