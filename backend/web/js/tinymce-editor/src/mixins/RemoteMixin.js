export default {
	methods: {
		remote( prop = '', ifEmpty = false ) {
			const initial = window.currentPageConfig;

			if ( ! prop ) {
				return initial;
			}

			prop = prop.match( /\w+(\/\w+)*/gi )[ 0 ];
			let props = prop.split( '/' );

			function inside( source, i = 0 ) {
				let current = source[ props[ i ] ];

				if ( props[ i + 1 ] && current ) {
					return inside( current, i + 1 );
				}

				return current ? current : ifEmpty;
			}

			return inside( initial );
		}
	}
}