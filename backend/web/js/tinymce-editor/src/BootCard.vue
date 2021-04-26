<template>
  <div class="card">
    <div class="card-header">
      {{ header }}
    </div>
    <div class="card-body">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "BootCard",
  props: {
    header: String
  }
}
</script>
