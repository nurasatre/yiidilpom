<template>
  <BAlert
    :show="dismissCountDown"
    dismissible
    :variant="variant"
    @dismissed="dismissCountDown=0"
    @dismiss-count-down="countDownChanged"
  >
    <slot></slot>
  </BAlert>
</template>

<script>
import {BAlert} from 'bootstrap-vue';

export default {
  name: "BootAlert",
  components: {BAlert},
  props: {
    timer: Number,
    variant: String
  },
  data() {
    return {
      dismissCountDown: 0
    };
  },
  methods: {
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    show( dismissSecs = this.timer ) {
      this.dismissCountDown = dismissSecs
    }
  }
}
</script>

<style scoped>

</style>
