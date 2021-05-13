export default {
	methods: {
		remote( prop = '' ) {
			return prop ? window.currentPageConfig[ prop ] : window.currentPageConfig;
		}
	}
}