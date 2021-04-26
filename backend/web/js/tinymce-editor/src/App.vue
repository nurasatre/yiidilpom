<template>
  <div id="app">
    <BootCard header="Title">
      <editor
        :api-key="api()"
        v-model="title"
        tag-name="h1"
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
      />
    </BootCard>
    <BootCard header="Content">
      <editor
        v-model="content"
        :inline="true"
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
        :api-key="api()"
      />
    </BootCard>
    <div class="button-wrapper">
      <button type="button" class="btn btn-primary btn-lg" @click="savePage">Save Page</button>
    </div>
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';
import BootCard from "./BootCard";

export default {
  name: 'app',
  components: {Editor, BootCard},
  data() {
    return {
      content: 'Start typing here...',
      title: 'My Page'
    }
  },
  methods: {
    savePage() {
      alert(this.content);
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

