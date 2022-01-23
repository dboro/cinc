<template>
  <v-btn nuxt @click.stop="$router.push(route)" rounded outlined :color="color">
    <slot></slot>
  </v-btn>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  mixins: [langs],
  name: "CButton",
  props: {
    route: Object,
    color: {
      default: 'indigo'
    }
  }
}
</script>

<style scoped>

</style>
