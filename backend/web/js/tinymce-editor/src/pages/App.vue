<template>
  <div id="app">
    <BootCard header="Title">
      <editor
        v-model="pageData.title"
        :api-key="api()"
        :init="{
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
          }"
        :inline="true"
        tag-name="h1"
      />
    </BootCard>
    <BootCard header="Content">
      <editor
        v-model="pageData.content"
        :api-key="api()"
        :init="{
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
        }"
        :inline="true"
      />
    </BootCard>
    <div class="button-wrapper">
      <button class="btn btn-primary btn-lg" type="button" @click="savePage">Save Page</button>
    </div>
    <notifications position="top center"/>
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';
import BootCard from "../components/BootCard";


const $ = jQuery;
const { action } = window.pageRequest;



export default {
  name: 'app',
  components: {Editor, BootCard},
  data() {
    return {
      pageData: {
        id: 0,
        content: 'Start typing here...',
        title: 'My Page',
        created_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
      }
    }
  },
  created() {
    const { model = {} } = window.pageRequest;

    this.pageData = { ...this.pageData, ...model };
  },
  methods: {

    savePage() {
      const self = this;

      $.ajax({
        ...window.pageAppConfig,
        data: this.pageData
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
      })
    },
    api() {
      return 'pfkvrcy9sxo3vvg58pnjy8c8kznnpti2ln4f34sb3oq0p7gb';
    }
  }
}
</script>

<style scoped>
#app {
  padding: 1rem;
}

#app > div:not(:last-child) {
  margin-bottom: 1.5rem;
}

#app .button-wrapper {
  text-align: end;
}

#app .mce-content-body {
  outline-offset: 20px;
}

</style>

