<template>
	<div id="app">
		<notifications position="top center"/>
		<BootCard header="Username">
			<input v-model="user.username" class="form-control" disabled type="text">
		</BootCard>
		<BootCard header="Email">
			<input v-model="user.email" class="form-control" disabled type="text">
		</BootCard>
		<!--    <div class="button-wrapper">
			  <button class="btn btn-primary btn-lg" type="button" @click="saveUser">Save User</button>
			</div>-->
	</div>
</template>

<script>
import BootCard from "../components/BootCard";
import RemoteMixin from "../mixins/RemoteMixin";

export default {
	name: "App",
	components: { BootCard },
	mixins: [ RemoteMixin ],
	data() {
		return {
			user: {
				username: '',
				email: ''
			}
		};
	},
	created() {
		this.user = { ...this.user, ...this.remote( 'model' ) };
	},
	methods: {
		saveUser() {
			const self = this;

			$.ajax( {
				...self.remote( 'save' ),
				data: self.user
			} ).done( function ( response ) {
				if ( response.success ) {
					self.$notify( {
						title: 'Response',
						type: 'success',
						text: response.success
					} );
				}
				else {
					self.$notify( {
						title: 'Response',
						type: 'error',
						text: response.error
					} );
				}
			} ).fail( function ( response ) {
				// Если произошла ошибка при отправке запроса
				self.$notify( {
					title: 'Response',
					type: 'error',
					text: response.error
				} );
			} )
		}
	}
}
</script>

<style scoped>
#app > div:not(:last-child) {
	margin-bottom: 1.5rem;
}
</style>
