<template>
  <v-btn nuxt @click.stop="$router.push(route)" rounded outlined color="indigo">
    <v-icon>mdi-arrow-left</v-icon>
    {{ t(label) }}
  </v-btn>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  mixins: [langs],
  name: "BackToButton",
  props: {
    label: {
      default: 'Back to List'
    },
    route: Object
  }
}
</script>

<style scoped>

</style>
