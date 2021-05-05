<template>
  <div class="app">
  <BootAlert variant="warning" :timer="5" ref="bootAlert">

  </BootAlert>
    <BFormFile
      :state="Boolean(files.length)"
      accept="image/*"
      class="mb-2"
      drop-placeholder="Drop file here..."
      multiple
      placeholder="Choose a file or drop it here..."
      @input="saveFiles"
      :value="files"
    >
      <template slot="file-name" slot-scope="{ names }">
        <BBadge variant="dark">{{ names[0] }}</BBadge>
        <BBadge v-if="names.length > 1" class="ml-1" variant="dark">
          + {{ names.length - 1 }} More files
        </BBadge>
      </template>
    </BFormFile>
    <BButton class="mr-2" @click="files = []">Reset files</BButton>
  </div>
</template>

<script>
import {BFormFile, BButton, BBadge, BAlert} from 'bootstrap-vue'
import BootAlert from "../components/BootAlert";

export default {
  name: "App",
  components: {BootAlert, BFormFile, BButton, BBadge, BAlert},
  data() {
    return {
      files: [],
      alertMessage: 'Success...'
    };
  },
  methods: {
    saveFiles(files) {

      /*$.ajax({
        ...window.userAppConfig,
        data: self.user
      }).done(function (response) {
        if (response.success) {
          self.$notify( {
            title: 'Response',
            type: 'success',
            text: response.success
          } );
        } else {
          self.$notify( {
            title: 'Response',
            type: 'error',
            text: response.error
          } );
        }
      }).fail(function ( response ) {
        // Если произошла ошибка при отправке запроса
        self.$notify( {
          title: 'Response',
          type: 'error',
          text: response.error
        } );
      })*/
      this.$refs.bootAlert.show();
    },
  }
}
</script>

<style scoped>

</style>
