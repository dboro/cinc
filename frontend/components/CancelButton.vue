<template>
  <v-btn @click.stop="$emit('click')" rounded outlined color="indigo">
    <slot>{{ t('Cancel') }}</slot>
  </v-btn>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  mixins: [langs],
  name: "CancelButton",
  props: {

  }
}
</script>

<style scoped>

</style>
